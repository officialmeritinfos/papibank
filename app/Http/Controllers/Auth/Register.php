<?php

namespace App\Http\Controllers\Auth;

use App\Defaults\Regular;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerification;
use App\Jobs\SendWelcomeMail;
use App\Models\Country;
use App\Models\EmailVerification;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\EmailVerifyMail;
use App\Notifications\InvestmentMail;
use App\Notifications\WelcomeMail;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class Register extends Controller
{
    use Regular;
    public function landingPage(Request $request)
    {
        $web = GeneralSetting::find(1);
        $dataView=[
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Accept Terms',
            'referral'=>$request->get('referral')
        ];

        return view('auth.accept_terms',$dataView);
    }
    public function registerForm(Request $request)
    {
        $web = GeneralSetting::find(1);
        $dataView=[
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Account Registration',
            'referral'=>$request->get('referral'),
            'countries' => Country::all(),
            'currencies' => Country::where('currency','USD')->take(1)->get(),
        ];

        return view('auth.register',$dataView);
    }

    public function authenticate(Request $request)
    {
        $web = GeneralSetting::find(1);

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'max:150'],
            'last_name' => ['required', 'max:150'],
            'username' => ['required', 'max:30', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'max:30','unique:users,phone'],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'occupation' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'postal_code' => ['nullable', 'max:30'],
            'street_address' => ['required', 'max:255'],
            'gender' => ['required', 'in:M,F'],
            'religion' => ['nullable', 'max:100'],
            'account_type' => ['required'],
            'account_currency' => ['required'],
            'referral' => ['nullable', 'exists:users,username'],
            'picture' => ['required', 'image', 'max:2048'],
            'g-recaptcha-response' => ['nullable', new Recaptcha],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($web->registration != 1) {
            return back()->with('error', 'Account registration is off at the moment');
        }

        if ($request->filled('referral')) {
            $ref = User::where('username', $request->input('referral'))->first();
            $refBy = $ref->id;
        } else {
            $refBy = null;
        }

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('profiles');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            $profilePicturePath = 'profiles/' . $filename;
        } else {
            $profilePicturePath = null;
        }

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'password' => Hash::make($request->input('password')),
            'occupation' => $request->input('occupation'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'street_address' => $request->input('street_address'),
            'gender' => $request->input('gender'),
            'religion' => $request->input('religion'),
            'account_type' => $request->input('account_type'),
            'account_currency' => $request->input('account_currency'),
            'referral' => $refBy,
            'idPhoto' => $profilePicturePath,
            'registrationIp' => $request->ip(),
            'email_verified_at' => $web->emailVerification==1?now():null,
            'emailVerified' => $web->emailVerification==1,
            'status' => 'active',
            'twoWay' => $web->twoFactor==1,
            'account_number' => generateUniqueAccountNumber()
        ]);

        if ($user) {
            //send verification email or welcome mail
            if (!$user->emailVerified){
                Notification::send($user, new EmailVerifyMail($user));
                $msg = "Registration successful. Check your email to verify your account.";
            }else{
                $user->notify(new WelcomeMail($user));
                $msg = "Registration successful. Proceed to login to your account.";
            }

            if ($refBy) {
                $ref->notify(new InvestmentMail($ref, "A new user registered using your referral link.", 'New Referral Registration'));
            }

            $admin = User::where('is_admin', 1)->first();
            if ($admin) {
                $admin->notify(new InvestmentMail($admin, "New user registered: {$user->first_name} {$user->last_name}.", 'New Registration'));
            }

            return redirect()->route('login')->with('info', $msg);
        }

        return back()->with('error', 'Unable to create account');
    }

    public function processVerifyEmail($email,$hash)
    {
        $user = User::where('username',$email)->firstOrFail();
        $exists = EmailVerification::where('email',$user->username)->where('token',$hash)
            ->orderBy('id','desc')->firstOrFail();

        if ($exists->expiration < time()){
            return redirect()->route('login')->with('error','Email Verification failed due to timeout');
        }
        User::where('id',$user->id)->update([
            'emailVerified'=>1
        ]);
        $user->markEmailAsVerified();

        EmailVerification::where('email',$email)->delete();

        $user->notify(new WelcomeMail($user));


        return redirect()->route('login')->with('info','Email successfully verified');
    }
}
