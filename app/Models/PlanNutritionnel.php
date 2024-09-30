<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanNutritionnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'type_alimentation',
        'calories_totale',
        'date_creation',
        'date_mise_a_jour',
        'ingredients', 
        'etapes', 
        'image', 
    ];
    
}

