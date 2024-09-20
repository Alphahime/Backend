<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_seance' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:pending,confirmed,completed',
        ];
    }
}
