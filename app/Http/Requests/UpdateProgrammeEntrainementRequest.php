<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgrammeEntrainementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string',
            'frequence' => 'required|string',
            'niveau_difficulte' => 'required|string',
            'type_programme' => 'required|in:en ligne,presentiel',
            'status' => 'required|in:actif,inactif',
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
        ];
    }
}
