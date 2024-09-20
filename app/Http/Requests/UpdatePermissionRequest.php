<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Assurez-vous de gérer l'autorisation correctement selon vos besoins
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:permissions,name,' . $this->permission->id,
            'guard_name' => 'required',
        ];
    }
}
