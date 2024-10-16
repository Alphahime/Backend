<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeEntrainement extends Model
{
    use HasFactory;

    // Utilisation de $guarded pour permettre l'assignation de masse sur tous les champs sauf ceux définis
    protected $guarded = [];

    // Relation avec les séances d'entraînement
    public function seancesEntrainement()
    {
        return $this->hasMany(SeanceEntrainement::class, 'programme_entrainement_id');
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
