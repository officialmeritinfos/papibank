<?php

namespace App\Mail;

use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDebitNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(User $user, AccountTransaction $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Withdrawal Successful - ' . config('app.name'))
            ->view('emails.user_debit_notification')
            ->with([
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
                'amount' => number_format($this->transaction->amount, 2),
                'transactionId' => $this->transaction->transaction_id,
                'status' => ucfirst($this->transaction->status),
                'created_at' => $this->transaction->created_at->format('F j, Y, g:i a'),
                'recipient_bank' => $this->transaction->recipient_bank_name,
                'account_number' => $this->transaction->account_number,
                'account_holder' => $this->transaction->account_holder,
            ]);
    }
}
