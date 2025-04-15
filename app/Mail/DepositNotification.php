<?php

namespace App\Mail;

use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositNotification extends Mailable
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
        return $this->subject('Deposit Confirmation - ' . env('APP_NAME'))
            ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->view('emails.deposit_notifications')
            ->with([
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
                'email' => $this->user->email,
                'amount' => number_format($this->transaction->amount, 2),
                'status' => ucfirst($this->transaction->status),
                'depositType' => ucfirst($this->transaction->deposit_type),
                'created_at' => $this->transaction->created_at->format('F j, Y, g:i a'),
            ]);
    }
}
