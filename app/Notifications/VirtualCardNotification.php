<?php

namespace App\Notifications;

use App\Models\VirtualCardRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VirtualCardNotification extends Notification
{
    use Queueable;
    protected $cardRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(VirtualCardRequest  $cardRequest) {
        $this->cardRequest = $cardRequest;
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
            ->subject('New Virtual Card Request')
            ->greeting('Hello Admin,')
            ->line('A new virtual card request has been submitted by ' . $this->cardRequest->user->first_name . ' ' . $this->cardRequest->user->last_name . '.')
            ->line('Card Type: ' . $this->cardRequest->card_type)
            ->line('Requested on: ' . now()->format('d M, Y'))
            ->action('Review Request', route('login'))
            ->line('Please take necessary action.');
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
