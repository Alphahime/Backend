<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'profil_verifie' => 'sometimes|boolean',
            'experience' => 'sometimes|string',
            'description' => 'sometimes|string',
            'lieu' => 'sometimes|string',
            'services' => 'sometimes|json',
            'galerie_photos' => 'sometimes|json',
            'diplomes' => 'sometimes|json',
            'disponibilites' => 'sometimes|json',
        ];
    }
}
