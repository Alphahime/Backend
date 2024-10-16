<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuiviSeance;
use App\Models\SeanceEntrainement;
use App\Models\ProgrammeEntrainement;
use App\Models\User;

class SuiviSeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vous pouvez ajuster le nombre d'éléments que vous souhaitez générer
        $numberOfSuiviSeances = 10;

        // Créez des enregistrements pour le suivi des séances
        for ($i = 0; $i < $numberOfSuiviSeances; $i++) {
            SuiviSeance::create([
                'user_id' => User::inRandomOrder()->first()->id, // Utilisateur aléatoire
                'seance_entrainement_id' => SeanceEntrainement::inRandomOrder()->first()->id, // Séance d'entraînement aléatoire
                'programme_entrainement_id' => ProgrammeEntrainement::inRandomOrder()->first()->id, // Programme d'entraînement aléatoire
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
