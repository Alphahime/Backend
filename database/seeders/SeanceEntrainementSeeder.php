<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeanceEntrainement;
use App\Models\ProgrammeEntrainement;

class SeanceEntrainementSeeder extends Seeder
{
    public function run()
    {
        // On récupère les programmes d'entraînement
        $programmes = ProgrammeEntrainement::all();

        if ($programmes->isEmpty()) {
            $this->command->error('No programmes d\'entraînement found in the database.');
            return;
        }

        $seances = [
            [
                'nom' => 'Séance 1 - Force',
                'description' => 'Focus sur la force avec des exercices de base.',
                'duree' => '60 minutes',
                'chronometre' => '30 minutes',
                'ordre' => 1,
            ],
            [
                'nom' => 'Séance 2 - Hypertrophie',
                'description' => 'Entraînement pour développer la masse musculaire.',
                'duree' => '60 minutes',
                'chronometre' => '30 minutes',
                'ordre' => 2,
            ],
            // Ajoutez d'autres séances si nécessaire
        ];

        foreach ($seances as $seanceData) {
            SeanceEntrainement::create(array_merge($seanceData, [
                'programme_entrainement_id' => $programmes->random()->id,
                'date_mise_a_jour' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
