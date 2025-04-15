<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\DepositNotification;
use App\Models\AccountTransaction;
use App\Models\BankTransferMethod;
use App\Models\CryptocurrencyMethod;
use App\Models\GeneralSetting;
use App\Models\GiftCardMethod;
use App\Models\User;
use App\Notifications\DepositMail;
use App\Notifications\DepositProofSubmitted;
use App\Notifications\NewDepositNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Deposit',
            'user'     =>  $user,
            'web'=>$web,
            'crypto_methods' => CryptocurrencyMethod::all(),
            'bank_methods' => BankTransferMethod::all(),
            'gift_card_methods' => GiftCardMethod::all()
        ];

        return view('user.deposit',$dataView);
    }

    public function deposit(Request $request)
    {
        $user = Auth::user();
        $settings = GeneralSetting::first();

        // Validate request
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:'.$settings->minDeposit],
            'crypto_method' => ['nullable', 'exists:cryptocurrency_methods,name'],
            'giftcard_type' => ['nullable', 'exists:gift_card_methods,merchant'],
            'bank_transfer' => ['nullable', 'exists:bank_transfer_methods,name'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Determine deposit type
        $depositType = null;
        $paymentMethodId = null;
        $transactionHash = null;

        // Generate a unique transaction reference
        $transactionRef = 'TXN-' . strtoupper(Str::random(4)).'-'.time();

        if ($request->filled('crypto_method')) {
            $depositType = 'crypto';
            $paymentMethodId = CryptocurrencyMethod::where('name', $request->crypto_method)->value('name');
        } elseif ($request->filled('giftcard_type')) {
            $depositType = 'gift_card';
            $paymentMethodId = GiftCardMethod::where('merchant', $request->giftcard_type)->value('merchant');
        } elseif ($request->filled('bank_transfer')) {
            $depositType = 'bank';
            $paymentMethodId = BankTransferMethod::where('name', $request->bank_transfer)->value('name');
        }

        if ($request->amount < $settings->minDeposit){
            return back()->with('error','Amount for deposit cannot be less than '.$user->account_currency.$settings->minDeposit);
        }

        // Create deposit transaction
        $transaction = AccountTransaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'deposit',
            'deposit_type' => $depositType,
            'amount' => $request->amount,
            'fee' => 0,
            'final_amount' => $request->amount,
            'status' => 'pending',
            'payment_method' => $paymentMethodId,
            'transaction_id' => $transactionRef
        ]);

        //Send Deposit Notification
        Mail::to($user->email)->send(new DepositNotification($user, $transaction));

        // Send notification to admin
        $admin = User::where('is_admin', 1)->first();
        if ($admin) {
            $admin->notify(new NewDepositNotification($transaction));
        }

        // Redirect to deposit details page
        return redirect()->route('deposit.detail', ['id' => $transaction->id])
            ->with('success', 'Deposit request submitted successfully. Please follow the instructions to complete your payment.');
    }

    public function showDeposit($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        // Retrieve the transaction
        $transaction = AccountTransaction::where('id', $id)
            ->where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->firstOrFail();

        // Fetch payment method details
        $paymentMethod = null;
        $instructions = '';
        $paymentDetails = [];

        switch ($transaction->deposit_type) {
            case 'crypto':
                $paymentMethod = CryptocurrencyMethod::where('name', $transaction->payment_method)->first();
                if ($paymentMethod) {
                    $instructions = "Send the exact deposit amount ({$transaction->amount} {$transaction->currency}) to the wallet address below.";
                    $paymentDetails = [
                        'Wallet Address' => $paymentMethod->wallet,
                        'Network' => $paymentMethod->network,
                        'Coin'=>$paymentMethod->name
                    ];
                }
                break;

            case 'gift_card':
                $paymentMethod = GiftCardMethod::where('merchant', $transaction->payment_method)->first();
                if ($paymentMethod) {
                    $instructions = "Enter your valid {$transaction->payment_method} gift card code to complete your deposit.";
                    $paymentDetails = [
                        'Merchant' => $paymentMethod->merchant,
                    ];
                }
                break;

            case 'bank':
                $paymentMethod = BankTransferMethod::where('name', $transaction->payment_method)->first();
                if ($paymentMethod) {
                    $instructions = "Transfer the deposit amount ({$transaction->amount} {$transaction->currency}) to the account details below and upload the payment receipt.";
                    $paymentDetails = [
                        'Bank Name' => $paymentMethod->name,
                        'Transfer Details' => $paymentMethod->detail,
                    ];
                }
                break;
        }


        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Deposit Detail',
            'user'     =>  $user,
            'web'=>$web,
            'transaction' => $transaction,
            'instructions' =>  $instructions,
            'paymentDetails'=>$paymentDetails,
        ];

        return view('user.deposit_detail',$dataView);
    }

    /**
     * Handle user payment confirmation submission.
     */
    public function submitPaymentProof(Request $request, $transactionId)
    {
        $transaction = AccountTransaction::where('id', $transactionId)
            ->where('user_id', Auth::id())
            ->where('transaction_type', 'deposit')
            ->firstOrFail();

        // Validate the required proof based on deposit type
        $request->validate([
            'transaction_hash' => $transaction->deposit_type === 'crypto' ? 'required|string|max:255' : 'nullable',
            'gift_card_code' => $transaction->deposit_type === 'gift_card' ? 'required|string|max:255' : 'nullable',
            'payment_receipt' => $transaction->deposit_type === 'bank' ? 'required|image|mimes:jpg,jpeg,png,pdf|max:2048' : 'nullable',
        ]);

        // Update transaction record
        if ($transaction->deposit_type === 'crypto') {
            $transaction->transaction_hash = $request->input('transaction_hash');
        } elseif ($transaction->deposit_type === 'gift_card') {
            $transaction->gift_card_code = $request->input('gift_card_code');
        } elseif ($transaction->deposit_type === 'bank' && $request->hasFile('payment_receipt')) {
            $receiptPath = $request->file('payment_receipt')->store('receipts', 'public');
            $transaction->payment_receipt = $receiptPath;
        }

        $transaction->status = 'pending';
        $transaction->save();

        // Send notification to admin
        $admin = User::where('is_admin', 1)->first();
        if ($admin) {
            $admin->notify(new DepositProofSubmitted($transaction));
        }

        return redirect()->route('deposit.detail', $transaction->id)
            ->with('success', 'Your payment proof has been submitted successfully and is under review.');
    }
}
