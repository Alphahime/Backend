<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'coach_id', 'date_seance', 'status'];

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }
    
    
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
