<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeanceEntrainementRequest extends FormRequest
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
            'chronometre' => 'nullable|string',
            'ordre' => 'required|integer',
            'date_mise_a_jour' => 'nullable|date',
            'programme_entrainement_id' => 'required|exists:programme_entrainements,id', 
        ];
    }
}
