<?php

namespace Database\Factories;

use App\Models\DomaineSportif;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomaineSportifFactory extends Factory
{
    protected $model = DomaineSportif::class;

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
