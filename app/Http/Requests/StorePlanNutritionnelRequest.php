<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanNutritionnelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Limite la longueur de la description
            'type_alimentation' => 'required|string|max:255', // Correctement nommer le champ 'type_alimentation'
            'calories_totale' => 'required|string|max:255', // Ajuster le type si c'est une chaîne de caractères
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du plan nutritionnel est requis.',
            'description.required' => 'La description du plan est requise.',
            'type_alimentation.required' => 'Le type d\'alimentation est requis.',
            'calories_totale.required' => 'Les calories totales sont requises.',
            'calories_totale.string' => 'Les calories doivent être une chaîne de caractères valide.',
        ];
    }
}
