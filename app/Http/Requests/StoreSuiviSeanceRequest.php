<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuiviSeanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'programme_entrainement_id' => 'required|integer|exists:programme_entrainements,id',
            'seance_entrainement_id' => 'required|integer|exists:seance_entrainements,id',
        ];
    }
}
