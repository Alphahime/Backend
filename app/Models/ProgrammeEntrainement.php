<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeEntrainement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seancesEntrainement()
    {
        return $this->hasMany(SeanceEntrainement::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function coaching()
    {
        return $this->belongsTo(Coaching::class);
    }
}

