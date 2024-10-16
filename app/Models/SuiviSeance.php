<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuiviSeance extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec SeanceEntrainement
    public function seanceEntrainement()
    {
        return $this->belongsTo(SeanceEntrainement::class);
    }

    // Relation avec ProgrammeEntrainement
    public function programmeEntrainement()
    {
        return $this->belongsTo(ProgrammeEntrainement::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
