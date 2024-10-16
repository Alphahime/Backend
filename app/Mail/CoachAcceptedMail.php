<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoachAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $temporaryPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $temporaryPassword)
    {
        $this->user = $user;
        $this->temporaryPassword = $temporaryPassword;
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
                        'password' => $this->temporaryPassword,  // Mot de passe dynamique
                    ]);
    }
}
