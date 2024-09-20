<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDomaineSportifRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Assurez-vous que l'utilisateur est autorisé à effectuer cette action
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
        ];
    }
}
