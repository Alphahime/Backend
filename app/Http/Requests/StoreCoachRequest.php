<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreCoachRequest",
 *     type="object",
 *     title="Store Coach Request",
 *     description="Request body for creating a new coach",
 *     required={"user_id", "profil_verifie"},
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="User ID associated with the coach"
 *     ),
 *     @OA\Property(
 *         property="profil_verifie",
 *         type="boolean",
 *         description="Coach profile verification status"
 *     ),
 *     @OA\Property(
 *         property="experience",
 *         type="string",
 *         description="Experience of the coach"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Coach description"
 *     ),
 *     @OA\Property(
 *         property="lieu",
 *         type="string",
 *         description="Location of the coach"
 *     ),
 *     @OA\Property(
 *         property="services",
 *         type="string",
 *         description="Services provided by the coach"
 *     ),
 *     @OA\Property(
 *         property="galerie_photos",
 *         type="string",
 *         description="Photo gallery of the coach"
 *     ),
 *     @OA\Property(
 *         property="diplomes",
 *         type="string",
 *         description="Coach's diplomas or certifications"
 *     ),
 *     @OA\Property(
 *         property="disponibilites",
 *         type="string",
 *         description="Coach's availability"
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
            'experience' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'lieu' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
            'galerie_photos' => 'nullable|string',
            'diplomes' => 'nullable|string',
            'disponibilites' => 'nullable|string',
        ];
    }
}
