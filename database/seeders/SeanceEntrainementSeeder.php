<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeanceEntrainementSeeder extends Seeder
{
    public function run()
    {
        $programmeId = DB::table('programme_entrainements')->where('id', 1)->value('id');
    
        DB::table('seance_entrainements')->insert([
            [
                'nom' => 'Séance Musculation Matin',
                'description' => 'Séance d\'entraînement de musculation en matinée.',
                'duree' => '1h',
                'chronometre' => '30 minutes',
                'ordre' => 1,
                'programme_entrainement_id' => $programmeId ?: null, // Utilise null si pas trouvé
                'date_mise_a_jour' => now()
            ],
        ]);
    }
    
}
