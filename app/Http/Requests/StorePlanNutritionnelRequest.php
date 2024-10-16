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
            'description' => 'required|string',
            'type_alimentation' => 'required|string|max:255',
            'calories_totale' => 'required|integer',
            'image' => 'nullable|image|max:2048', 
            'ingredients' => 'required|json',
            'etapes' => 'required|json',
            '
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
            'image.mimes' => 'L\'image doit être au format jpg, jpeg ou png.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'ingredient.required' => 'Au moins un ingrédient est requis.',
            'etape_a_suivre.required' => 'Au moins une étape est requise.',
        ];
    }
}
