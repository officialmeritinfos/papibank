<?php

namespace App\Notifications;

use App\Models\AccountTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositProofSubmitted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $transaction;

    public function __construct(AccountTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Deposit Payment Proof Submitted')
            ->greeting('Hello Admin,')
            ->line("A user has submitted proof for their deposit.")
            ->line("**User:** {$this->transaction->user->first_name} ({$this->transaction->user->email})")
            ->line("**Deposit Type:** " . ucfirst($this->transaction->deposit_type))
            ->line("**Amount:** $" . number_format($this->transaction->amount, 2))
            ->line("**Status:** Pending Verification")
            ->action('Review Deposit', route('admin.deposits.detail',['id'=>$this->transaction->id]))
            ->line('Please verify and approve/reject the deposit.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
