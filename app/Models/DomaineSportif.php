<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomaineSportif extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ressources()
    {
        return $this->hasMany(Ressource::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function programmesEntrainement()
    {
        return $this->hasMany(ProgrammeEntrainement::class);
    }
    
}
