<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles; // Ajoute cette ligne

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasRoles; // Ajoute HasRoles ici

    /**
     * Les attributs qui ne sont pas mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', 'prenom', 'email', 'mot_de_passe', 'telephone', 'localisation',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mot_de_passe', 'remember_token',
    ];

    /**
     * Retourne le mot de passe pour l'authentification.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Les attributs qui doivent être castés en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retourne l'identifiant unique pour JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retourne un tableau de revendications personnalisées à ajouter au JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relations avec les modèles
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

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    // Ne pas inclure la méthode roles() ici car elle est gérée par le trait HasRoles

    public function setPasswordAttribute($value)
    {
        $this->attributes['mot_de_passe'] = bcrypt($value);
    }
}
