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
            'contenu' => 'required|string',  
            'article_id' => 'required|exists:articles,id',
            'blog_id' => 'required|exists:blogs,id',
        ];
    }
}
