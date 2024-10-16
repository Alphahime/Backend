<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoachAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.coach_accepted')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'password' => 'password_temporaire',  // Vous pouvez remplacer par un mot de passe généré dynamiquement
                    ]);
    }
}
