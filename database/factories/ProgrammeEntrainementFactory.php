<?php

namespace Database\Factories;

use App\Models\ProgrammeEntrainement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgrammeEntrainementFactory extends Factory
{
    protected $model = ProgrammeEntrainement::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->text,
            'duree' => $this->faker->word,
            'frequence' => $this->faker->word,
            'niveau_difficulte' => $this->faker->word,
            'type_programme' => $this->faker->randomElement(['en ligne', 'presentiel']),
            'status' => $this->faker->randomElement(['actif', 'inactif']),
            'date_creation' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
