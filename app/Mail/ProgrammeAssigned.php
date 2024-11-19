<?php

namespace App\Mail;

use App\Models\ProgrammeEntrainement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProgrammeAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $programme;

    /**
     * Crée une nouvelle instance de message.
     *
     * @param User $user
     * @param ProgrammeEntrainement $programme
     */
    public function __construct(User $user, ProgrammeEntrainement $programme)
    {
        $this->user = $user;
        $this->programme = $programme;
    }

    /**
     * Construire le message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau programme d\'entraînement assigné')
                    ->view('emails.programmeAttribue');
    }
}
