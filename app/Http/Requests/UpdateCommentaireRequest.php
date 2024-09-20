<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contenu' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id',
            'article_id' => 'sometimes|required|exists:articles,id',
            'blog_id' => 'sometimes|required|exists:blogs,id',
        ];
    }
}
