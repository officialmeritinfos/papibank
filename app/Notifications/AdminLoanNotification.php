<?php

namespace App\Notifications;

use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLoanNotification extends Notification
{
    use Queueable;
    public $loan,$user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(LoanRequest $loan,User  $user =null)
    {
        $this->loan = $loan;
        $this->user = $user;
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
            ->subject('New Loan Request Received')
            ->greeting('Hello Admin,')
            ->line('A new loan request has been submitted.')
            ->line('Amount: '.$this->user->account_currency . number_format($this->loan->amount, 2))
            ->line('Support Category: ' . $this->loan->credit_facility)
            ->line('Grant Period: ' . $this->loan->payment_tenure)
            ->line('User: ' . $this->loan->user->first_name.' '.$this->loan->user->last_name)
            ->action('View Request', route('login'))
            ->line('Please review and process this request.');
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
