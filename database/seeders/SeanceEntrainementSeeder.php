<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeanceEntrainementSeeder extends Seeder
{
    public function run()
    {
        $seances = [
            [
                'nom' => 'Séance 1 - Force',
                'description' => 'Focus sur la force avec des exercices de base.',
                'duree' => '60 minutes',
                'chronometre' => '30 minutes',
                'ordre' => 1,
                'date_mise_a_jour' => now(),
                'programme_entrainement_id' => 5, // Remplacez avec un ID valide
            ],
            [
                'nom' => 'Séance 2 - Hypertrophie',
                'description' => 'Entraînement pour développer la masse musculaire.',
                'duree' => '60 minutes',
                'chronometre' => '30 minutes',
                'ordre' => 2,
                'date_mise_a_jour' => now(),
                'programme_entrainement_id' => 6, // Remplacez avec un ID valide
            ],
            // Ajoutez d'autres séances avec des IDs valides
        ];

        foreach ($seances as $seance) {
            DB::table('seance_entrainements')->insert(array_merge($seance, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
