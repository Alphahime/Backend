<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="StoreCoachRequest",
 *     type="object",
 *     title="Store Coach Request",
 *     description="Request body for creating a new coach",
 *     required={"name", "email"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the coach"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Email of the coach"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Phone number of the coach"
 *     )
 * )
 */
class StoreCoachRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'profil_verifie' => 'required|boolean',
            'experience' => 'required|string',
            'description' => 'required|string',
            'lieu' => 'required|string',
            'services' => 'required|json',
            'galerie_photos' => 'nullable|json',
            'diplomes' => 'nullable|json',
            'disponibilites' => 'nullable|json',
        ];
    }
}
