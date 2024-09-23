<?php

// app/Models/Coach.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'profil_verifie', 'experience', 'description', 'lieu', 
        'services', 'galerie_photos', 'diplomes', 'disponibilites'
    ];

  
    protected $casts = [
        'services' => 'array',
        'galerie_photos' => 'array',
        'diplomes' => 'array',
        'disponibilites' => 'array',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
