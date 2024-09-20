<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contenu' => 'required|string',
            'date_envoie' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
        ];
    }
}
