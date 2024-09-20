<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationCreated extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a new reservation.')
            ->line('Client: ' . $this->reservation->client->name)
            ->line('Date: ' . $this->reservation->date_seance)
            ->action('View Reservation', url('/reservations/' . $this->reservation->id))
            ->line('Thank you for using our application!');
    }
}
