<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanNutritionnelRequest extends FormRequest
{
    public function authorize()
    {
        // Autorise toujours l'utilisation de cette requête, tu peux personnaliser si nécessaire
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Limite la longueur de la description
            'type_alimentation' => 'required|string|max:255', // Correctement nommer le champ 'type_alimentation'
            'calories_totale' => 'required|numeric|min:0', // Doit être un nombre
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
            'calories_totale.numeric' => 'Les calories doivent être un nombre valide.',
        ];
    }
}
