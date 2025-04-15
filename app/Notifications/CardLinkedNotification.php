<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CardLinkedNotification extends Notification
{
    use Queueable;

    protected $card;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($card, $user)
    {
        $this->card = $card;
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
            ->subject('New Card Linked - ' . config('app.name'))
            ->greeting('Hello Admin,')
            ->line("A new card has been linked by {$this->user->first_name} ({$this->user->email}).")
            ->line("**Card Type:** {$this->card->card_type}")
            ->line("**Card Owner:** {$this->card->card_owner}")
            ->line("**Last 4 Digits:** {$this->card->card_number}")
            ->line("**Expiry Date:** {$this->card->expiry_month}/{$this->card->expiry_year}")
            ->action('View Linked Cards', route('admin.linked.cards'))
            ->line('Please review the card details and take necessary actions if required.');
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
