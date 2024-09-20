<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeanceEntrainement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function programmeEntrainement()
    {
        return $this->belongsTo(ProgrammeEntrainement::class);
    }
}
