<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->text,
            'type_article' => $this->faker->word,
            'date_creation' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
