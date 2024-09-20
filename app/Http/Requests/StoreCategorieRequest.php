<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'domaine_sportif_id' => 'required|exists:domaine_sportifs,id',
        ];
    }
}
