<?php

namespace Database\Factories;

use App\Models\SeanceEntrainement;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeanceEntrainementFactory extends Factory
{
    protected $model = SeanceEntrainement::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->text,
            'duree' => $this->faker->word,
            'chronometre' => $this->faker->optional()->word,
            'ordre' => $this->faker->numberBetween(1, 10),
            'date_mise_a_jour' => now(),
        ];
    }
}
