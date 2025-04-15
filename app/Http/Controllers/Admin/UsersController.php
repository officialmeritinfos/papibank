<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\BillPayment;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\LinkedCard;
use App\Models\LoanRequest;
use App\Models\User;
use App\Models\VirtualCardRequest;
use App\Notifications\EmailVerifyMail;
use App\Notifications\InvestmentMail;
use App\Notifications\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Users',
            'user'     =>  $user,
            'users'  => User::where('status','active')->get()
        ];

        return view('admin.users.list',$dataView);
    }
    //inactive users
    public function inactiveUsers()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Users',
            'user'     =>  $user,
            'users'  => User::where('status','!=','active')->get()
        ];

        return view('admin.users.list',$dataView);
    }
    //add new user
    public function newUser()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Create New User',
            'user'     =>  $user,
            'countries' => Country::all(),
            'currencies' => Country::groupBy('currency')->get(),
        ];

        return view('admin.users.new',$dataView);
    }
    //process new user
    public function createUser(Request $request)
    {
        $web = GeneralSetting::find(1);
        $admin = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'max:150'],
            'last_name' => ['required', 'max:150'],
            'username' => ['required', 'max:30', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'max:30', 'unique:users,phone'],
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

        $profilePicturePath = $request->file('picture') ? $request->file('picture')->store('profiles', 'public') : null;

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
            'profile_picture' => $profilePicturePath,
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
                $msg = "Registration successful. Check the email to verify their account.";
            }else{
                Notification::send($user, new WelcomeMail($user));
                $msg = "Registration successful.";
            }

            if ($refBy) {
                $ref->notify(new InvestmentMail($ref, "A new user registered using your referral link.", 'New Referral Registration'));
            }

            $admin = User::where('is_admin', 1)->first();
            if ($admin) {
                $admin->notify(new InvestmentMail($admin, "New user registered: {$user->first_name} {$user->last_name}.", 'New Registration'));
            }

            return redirect()->route('admin.users.index')->with('info', $msg);
        }

        return back()->with('error', 'Unable to create account');
    }
    //login user
    public function loginUser($id)
    {
        $web = GeneralSetting::where('id',1)->first();
        $admin = Auth::user();

        $user = User::where('id',$id)->first();

        Auth::logout();

        Auth::login($user);

        return redirect(route('user.dashboard')) ->with('success','Login Successful');

    }
    //details
    public function userDetails($id)
    {
        $web = GeneralSetting::find(1);
        $admin = Auth::user();

        $user = User::where('id', $id)->first();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'User Detail',
            'user'     =>  $admin,
            'account'  =>  $user,
            'transactions' => AccountTransaction::where('user_id', $user->id)->latest()->paginate(10,'*','transaction'),
            'loans' => LoanRequest::where('user_id', $user->id)->latest()->paginate(15,'*','loans'),
            'billPayments' => BillPayment::where('user_id', $user->id)->latest()->paginate(15,'*','payments'),
            'linkedCards' => LinkedCard::where('user_id', $user->id)->latest()->paginate(15,'*','linkedCards'),
            'virtualCards' => VirtualCardRequest::where('user_id', $user->id)->latest()->paginate(10, '*', 'virtualCards'),
        ];

        return view('admin.users.details',$dataView);
    }

    /**
     * Add funds to user balance.
     */
    public function addFunds(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|min:0.01']);

        $account = User::findOrFail($id);
        $account->balance += $request->amount;
        $account->save();

        $transactionId = "TXN-".strtoupper(Str::random(5)).'-'.time();
        // Log transaction
        AccountTransaction::create([
            'user_id' => $account->id,
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'status' => 'completed',
            'transaction_id' => $transactionId,
            'payment_method' => 'Bitcoin',
            'deposit_type' => 'crypto'
        ]);

        return back()->with('success', 'Funds added successfully.');
    }

    /**
     * Deduct funds from user balance.
     */
    public function deductFunds(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|min:0.01']);

        $account = User::findOrFail($id);
        if ($account->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        $account->balance -= $request->amount;
        $account->save();

        $transactionId = "WD-".strtoupper(Str::random(5)).'-'.time();
        // Log transaction
        AccountTransaction::create([
            'user_id' => $account->id,
            'transaction_type' => 'withdrawal',
            'amount' => $request->amount,
            'status' => 'completed',
            'transaction_id' => $transactionId,
        ]);

        return back()->with('success', 'Funds deducted successfully.');
    }

    /**
     * Add loan amount to user.
     */
    public function addLoan(Request $request, $id)
    {
        $request->validate(['loan_amount' => 'required|numeric|min:1']);

        $account = User::findOrFail($id);
        $account->loan += $request->loan_amount;
        $account->save();

        return back()->with('success', 'Loan added successfully.');
    }

    /**
     * Deduct loan from user account.
     */
    public function deductLoan(Request $request, $id)
    {
        $request->validate(['loan_amount' => 'required|numeric|min:1']);

        $account = User::findOrFail($id);
        if ($account->loan < $request->loan_amount) {
            return back()->with('error', 'User does not have enough loan balance.');
        }

        $account->loan -= $request->loan_amount;
        $account->save();

        return back()->with('success', 'Loan amount deducted successfully.');
    }

    /**
     * Add credit score to user account.
     */
    public function addCreditScore(Request $request, $id)
    {
        $request->validate(['credit_score' => 'required|numeric|min:1']);

        $account = User::findOrFail($id);
        $account->credit_score += $request->credit_score;
        $account->save();

        return back()->with('success', 'Credit score increased successfully.');
    }

    /**
     * Deduct credit score from user account.
     */
    public function deductCreditScore(Request $request, $id)
    {
        $request->validate(['credit_score' => 'required|numeric|min:1']);

        $account = User::findOrFail($id);
        if ($account->credit_score < $request->credit_score) {
            return back()->with('error', 'User does not have enough credit score.');
        }

        $account->credit_score -= $request->credit_score;
        $account->save();

        return back()->with('success', 'Credit score decreased successfully.');
    }

    /**
     * Delete a user account (Soft Delete)
     */
    public function deleteUser($id)
    {
        $account = User::findOrFail($id);
        // Ensure admin cannot delete themselves
        if (auth()->user()->id === $account->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Soft delete the user
        $account->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    //Deactivate user
    public function deactivateUser($id)
    {
        User::where('id', $id)->update(['status' => 'suspended']);

        return redirect()->route('admin.users.index')->with('success', 'User suspended successfully.');
    }
    //activate user
    public function activateUser($id)
    {
        User::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('admin.users.index')->with('success', 'User activated successfully.');
    }

    public function activateWithdrawal($id)
    {
        User::where('id', $id)->update(['canWithdraw' => 1]);

        return back()->with('success', 'Withdrawal activated successfully.');
    }

    public function deactivateWithdrawal($id)
    {
        User::where('id', $id)->update(['canWithdraw' => 2]);

        return back()->with('success', 'Withdrawal deactivated successfully.');
    }
}
