<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules(): array
    {
        return [
            //'coach_id' => 'required|exists:coaches,id',
            //'date_seance' => 'required|date',
            //'status' => 'required|string|in:pending,completed,cancelled', // Example statuses
        ];
    }
}
