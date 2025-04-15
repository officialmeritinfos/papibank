<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMail extends Notification
{
    use Queueable;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
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
            ->subject('Welcome to '.env('APP_NAME'))
            ->greeting('Hello '.$this->user->first_name)
            ->line('Welcome to '.env('APP_NAME').'! We are delighted to have you as part of our banking family. <br>
        <p>At '.env('APP_NAME').', we are committed to providing you with secure, reliable, and efficient banking services tailored to your financial needs.</p>
        <p>With our innovative banking solutions, you can easily manage your accounts, perform seamless transactions, and access financial services with ease.</p>
        <p>We value your trust and are here to support your financial journey. If you have any questions or need assistance, do not hesitate to contact our customer support team.</p>')
            ->line('Thank you for choosing '.env('APP_NAME').' for your banking needs!');
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
