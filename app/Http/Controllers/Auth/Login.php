<?php

namespace App\Http\Controllers\Auth;

use App\Defaults\Regular;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerification;
use App\Jobs\SendTwoFactorMail;
use App\Models\GeneralSetting;
use App\Models\TwoFactor;
use App\Models\User;
use App\Notifications\EmailVerifyMail;
use App\Notifications\LoginMail;
use App\Notifications\TwoFactorMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    use Regular;
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $dataView = [
            'web'   =>  $web,
            'siteName'  =>  $web->name,
            'pageName'  =>  'Login Page'
        ];
        return view('auth.login',$dataView);
    }

    public function authenticate(Request $request)
    {
        $web = GeneralSetting::find(1);

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'exists:users,username'],
            'password' => ['required', 'string'],
        ], [], ['username' => 'Username']);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();

        if (!Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return back()->with('error', 'Invalid username or password');
        }

        $user = Auth::user();

        if ($user->status !== 'active') {
            Auth::logout();
            return back()->with('error', 'Your account is inactive. Please contact support.');
        }

        if (!$user->email_verified_at) {
            Notification::send($user, new EmailVerifyMail($user));
            Auth::logout();
            return back()->with('success', 'Email Verification mail sent. Please check your inbox and spam folder.');
        }

        if ($user->twoWay==1) {
            Notification::send($user, new TwoFactorMail($user));
            User::where('id', $user->id)->update(['twoWayPassed' => false]);
            Auth::logout();
            return back()->with('info', 'Two-factor authentication required. Please check your email.');
        }

        User::where('id', $user->id)->update(['twoWayPassed' => true]);

        $redirectRoute = $user->is_admin ? route('admin.admin.dashboard') : route('user.dashboard');

        return redirect($redirectRoute)->with('info', 'Login successful.');
    }
    public function processTwoFactor($email,$hash,Request $request)
    {
        //verify login
        $user = User::where('username',$email)->firstOrFail();
        $exists = TwoFactor::where('user',$user->id)->where('token',$hash)->firstOrFail();

        if ($exists->expiration < time()){
            return redirect()->route('login')->with('error','Authentication failed due to timeout');
        }
        Auth::loginUsingId($user->id);
        //$user->notify(new LoginMail($user,$request));

        $user->twoWayPassed=true;
        $user->save();

        TwoFactor::where('user',$user->id)->delete();

        if ($user->is_admin ==1){
            $url = route('admin.admin.dashboard');
        }else {
            $url = route('user.dashboard');
        }

        return redirect($url)->with('success','Login successful.');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->twoWayPassed=false;
        $user->save();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info','Logout was successful');
    }
}
