<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'date_creation' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
