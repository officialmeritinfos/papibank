<?php

namespace App\Notifications;

use App\Models\AccountTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDepositNotification extends Notification
{
    use Queueable;
    protected $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
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
            ->subject('New Deposit Initiated')
            ->greeting('Hello Admin,')
            ->line("A new deposit has been created.")
            ->line("**User:** {$this->transaction->user->first_name} ({$this->transaction->user->email})")
            ->line("**Deposit Type:** " . ucfirst($this->transaction->deposit_type))
            ->line("**Amount:** $" . number_format($this->transaction->amount, 2))
            ->line("**Status:** Pending")
            ->action('View Deposit', route('admin.deposits.detail',['id'=>$this->transaction->id]))
            ->line('Please review and process accordingly.');
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
