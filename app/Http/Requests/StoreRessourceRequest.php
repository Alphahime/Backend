<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRessourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_ressource' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lien' => 'required|url',
            'video' => 'nullable|string',
            'image' => 'nullable|string',
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
        ];
    }
}
