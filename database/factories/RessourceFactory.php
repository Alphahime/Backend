<?php

namespace Database\Factories;

use App\Models\Ressource;
use Illuminate\Database\Eloquent\Factories\Factory;

class RessourceFactory extends Factory
{
    protected $model = Ressource::class;

    public function definition()
    {
        return [
            'type_ressource' => $this->faker->word,
            'titre' => $this->faker->word,
            'description' => $this->faker->text,
            'lien' => $this->faker->url,
            'video' => $this->faker->optional()->url,
            'image' => $this->faker->optional()->imageUrl,
            'date_creation' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
