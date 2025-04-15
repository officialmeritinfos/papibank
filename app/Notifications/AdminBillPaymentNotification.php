<?php

namespace App\Notifications;

use App\Models\BillPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBillPaymentNotification extends Notification
{
    use Queueable;

    protected $billPayment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BillPayment $billPayment)
    {
        $this->billPayment = $billPayment;
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
            ->subject('New Bill Payment Request')
            ->greeting('Hello Admin,')
            ->line('A new bill payment request has been initiated by a user.')
            ->line('**User:** ' . $this->billPayment->user->first_name. ' ' . $this->billPayment->user->last_name )
            ->line('**Account Number:** ' . $this->billPayment->account_number)
            ->line('**Payee:** ' . $this->billPayment->payee)
            ->line('**Amount:** $' . number_format($this->billPayment->amount, 2))
            ->line('**Delivery Method:** ' . $this->billPayment->delivery_method)
            ->line('**Delivery Date:** ' . $this->billPayment->delivery_date)
            ->line('**Status:** Pending Approval')
            ->action('Review Payment', route('login'))
            ->line('Please review and approve or reject the payment request.')
            ->line('Thank you for your attention.');
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
