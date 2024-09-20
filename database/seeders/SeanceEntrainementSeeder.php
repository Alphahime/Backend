<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeanceEntrainementSeeder extends Seeder
{
    public function run()
    {
        DB::table('seance_entrainements')->insert([
            [
                'nom' => 'Séance Musculation Matin',
                'description' => 'Séance d\'entraînement de musculation en matinée.',
                'duree' => '1h',
                'chronometre' => '30 minutes',
                'ordre' => 1,
                'programme_entrainement_id' => 1, // Assure-toi que cette valeur existe dans la table `programme_entrainements`
                'date_mise_a_jour' => now()
            ],
        ]);
    }
}
