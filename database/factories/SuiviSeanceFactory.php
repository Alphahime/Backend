<?php

namespace Database\Factories;

use App\Models\SuiviSeance;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuiviSeanceFactory extends Factory
{
    protected $model = SuiviSeance::class;

    public function definition()
    {
        return [
            'programme_entrainement_id' => \App\Models\ProgrammeEntrainement::factory(),
            'seance_entrainement_id' => \App\Models\SeanceEntrainement::factory(),
        ];
    }
}
