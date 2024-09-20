<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Définir la relation avec DomaineSportif
     */
    public function domaineSportif()
    {
        return $this->belongsTo(DomaineSportif::class);
    }

    /**
     * Définir la relation avec ProgrammeEntrainement
     */
    public function programmeEntrainements()
    {
        return $this->hasMany(ProgrammeEntrainement::class, 'categorie_id');
    }

   
}
