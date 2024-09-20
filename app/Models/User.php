<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * Les attributs qui ne sont pas mass-assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relations avec les modèles
     */

    public function planNutritionnel()
    {
        return $this->hasOne(PlanNutritionnel::class);
    }

    public function domaines()
    {
        return $this->belongsToMany(DomaineSportif::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
