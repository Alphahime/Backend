<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationCompleted extends Notification
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
            ->line('Your coaching session has been completed.')
            ->line('Coach: ' . $this->reservation->coach->name)
            ->line('Date: ' . $this->reservation->date_seance)
            ->line('Thank you for using our application!');
    }
}

