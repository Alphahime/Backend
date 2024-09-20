<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id', 'coach_id', 'date_seance', 'status',
        // autres attributs
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
