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
            'description' => 'required|string|max:1000',
            'type_alimentation' => 'required|string|max:255',
            'calories_totale' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ingredient' => 'required|array', // Changer de string à array
            'ingredient.*' => 'string|max:255', // Validation pour chaque élément de l'array
            'etape_a_suivre' => 'required|array', // Changer de string à array
            'etape_a_suivre.*' => 'string|max:255', // Validation pour chaque élément de l'array
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
