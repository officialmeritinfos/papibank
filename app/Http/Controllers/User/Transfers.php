<?php

namespace App\Http\Controllers\User;

use App\Defaults\Regular;
use App\Http\Controllers\Controller;
use App\Mail\AdminDebitNotification;
use App\Mail\UserDebitNotification;
use App\Models\AccountTransaction;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Transfers extends Controller
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Transfer Funds',
            'user'     =>  $user,
            'web'       =>$web,
        ];

        return view('user.transfers',$dataView);
    }
    //landing page
    public function cryptoTransfer()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Crypto Transfers',
            'user'     =>  $user,
            'web'       =>$web,
        ];

        return view('user.transfer_crypto',$dataView);
    }

    public function newTransfer(Request  $request)
    {
        $user = Auth::user();
        $settings = GeneralSetting::first();

        // Validate request
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:1'],
            'recipient_bank_name' => ['required', 'string', 'max:255'],
            'bank_sort_code' => ['nullable', 'string', 'max:50'],
            'swift_code' => ['nullable', 'string', 'max:50'],
            'account_number' => ['required', 'string', 'max:50'],
            'target' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            // Ensure user has sufficient balance
            if ($user->balance < $request->amount) {
                return back()->with('error', 'Insufficient balance for withdrawal.');
            }

            if ($user->canWithdraw !=1){
                return back()->with('error', 'Withdrawal is not allowed. Please contact support.');
            }

            // Generate a unique transaction ID
            $transactionId = 'WD-' . strtoupper(Str::random(5)).'-'.time();

            // Insert withdrawal transaction into the database
            $transaction = AccountTransaction::create([
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'transaction_type' => 'withdrawal',
                'amount' => $request->amount,
                'deposit_type'=>'bank',
                'fee' => 0, // Fees can be dynamically set
                'final_amount' => $request->amount, // Adjust based on fee if needed
                'status' => 'pending',
                'payment_method' => null,
                'transaction_hash' => null,
                'gift_card_code' => null,
                'payment_receipt' => null,
                'recipient_bank_name' => $request->recipient_bank_name,
                'bank_sort_code' => $request->bank_sort_code,
                'swift_code' => $request->swift_code,
                'account_number' => $request->account_number,
                'account_holder' => $request->target,
                'description' => $request->description,
            ]);

            // Deduct balance
            $user->balance -= $request->amount;
            $user->save();

            DB::commit();
            // Send notification emails
            Mail::to($user->email)->send(new UserDebitNotification($user, $transaction)); // Notify User
            $admin = User::where('is_admin', 1)->first();
            if ($admin) {
                Mail::to($admin->email)->send(new AdminDebitNotification($user, $transaction)); // Notify Admin
            }
            return redirect()->route('transfer.detail', ['id' => $transaction->id])
                ->with('success', 'Your withdrawal request has been submitted successfully.');
        }catch (\Exception $exception){
            DB::rollBack();
            logger($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function newCryptoTransfer(Request  $request)
    {
        $user = Auth::user();
        $settings = GeneralSetting::first();

        // Validate request
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:1'],
            'recipient_coin' => ['required', 'string', 'max:255'],
            'recipient_coin_network' => ['required', 'string', 'max:50'],
            'wallet_address' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {

            // Ensure user has sufficient balance
            if ($user->balance < $request->amount) {
                return back()->with('error', 'Insufficient balance for withdrawal.');
            }

            if ($user->canWithdraw !=1){
                return back()->with('error', 'Insufficient USDT to process withdrawal. Please contact support.');
            }

            // Generate a unique transaction ID
            $transactionId = 'WD-CRYPTO-' . strtoupper(Str::random(5)).'-'.time();

            // Insert withdrawal transaction into the database
            $transaction = AccountTransaction::create([
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'transaction_type' => 'withdrawal',
                'amount' => $request->amount,
                'deposit_type'=>'crypto',
                'fee' => 0, // Fees can be dynamically set
                'final_amount' => $request->amount, // Adjust based on fee if needed
                'status' => 'pending',
                'payment_method' => null,
                'transaction_hash' => null,
                'gift_card_code' => null,
                'payment_receipt' => null,
                'recipient_bank_name' => $request->recipient_coin,
                'bank_sort_code' => $request->recipient_coin_network,
                'account_number' => $request->wallet_address,
                'account_holder' => $user->first_name.' '.$user->last_name,
                'description' => $request->description??'Crypto withdrawal',
            ]);

            // Deduct balance
            $user->balance -= $request->amount;
            $user->save();

            DB::commit();
            // Send notification emails
            Mail::to($user->email)->send(new UserDebitNotification($user, $transaction)); // Notify User
            $admin = User::where('is_admin', 1)->first();
            if ($admin) {
                Mail::to($admin->email)->send(new AdminDebitNotification($user, $transaction)); // Notify Admin
            }
            return redirect()->route('transfer.detail', ['id' => $transaction->id])
                ->with('success', 'Your withdrawal request has been submitted successfully.');
        }catch (\Exception $exception){
            DB::rollBack();
            logger($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function showDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        // Retrieve the withdrawal transaction by ID
        $transaction = AccountTransaction::where('id', $id)
            ->where('transaction_type', 'withdrawal')
            ->where('user_id', $user->id)
            ->firstOrFail();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Transfer Detail',
            'user'     =>  $user,
            'web'       =>$web,
            'transaction' =>$transaction,
        ];

        $view = "user.transfer_detail";
        if ($transaction->deposit_type=='crypto'){
            $view = "user.transfer_crypto_detail";
        }

        return view($view,$dataView);
    }
}
