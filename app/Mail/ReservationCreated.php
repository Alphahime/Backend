<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->view('emails.reservation_created')
                    ->with([
                        'name' => $this->reservation->coach ? $this->reservation->coach->name : 'Inconnu',
                        'date' => $this->reservation->date_seance,
                    ]);
    }
}
