<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contenu' => 'required|string|max:500',
            'email' => 'required|email',
            'mot_de_passe' => 'required|string|min:6',
            'article_id' => 'required|integer|exists:articles,id',
            'blog_id' => 'required|integer|exists:blogs,id',
        ];
    }
}
