<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->text,
            'date_creation' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
