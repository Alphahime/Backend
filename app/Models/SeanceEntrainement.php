<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeanceEntrainement extends Model
{
    use HasFactory;

    // Utilisation de $fillable pour définir les champs assignables en masse
    protected $fillable = [
        'nom',
        'description',
        'duree',
        'chronometre',
        'ordre',
        'date_mise_a_jour',
        'programme_entrainement_id',
    ];

    // Relation avec le programme d'entraînement
    public function programme()
    {
        return $this->belongsTo(ProgrammeEntrainement::class, 'programme_entrainement_id');
    }
}
