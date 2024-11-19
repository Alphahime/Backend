<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeanceEntrainement;
use App\Models\ProgrammeEntrainement;

class SeanceEntrainementSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les programmes d'entraînement existants
        $programmes = [
            [
                'programme_entrainement_id' => 2, 
                'seances' => [
                    ['nom' => 'Séance Cardio 1', 'description' => 'Séance de cardio intensif', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 1],
                    ['nom' => 'Séance Cardio 2', 'description' => 'Séance de cardio pour brûler des calories', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 2],
                    ['nom' => 'Séance Cardio 3', 'description' => 'Séance de cardio pour améliorer l’endurance', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 3],
                    ['nom' => 'Séance Cardio 4', 'description' => 'Séance de cardio intensif pour brûler des graisses', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 4],
                ]
            ],
            [
                'programme_entrainement_id' => 3, 
                'seances' => [
                    ['nom' => 'Séance Musculation 1', 'description' => 'Séance de musculation pour débutants', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 1],
                    ['nom' => 'Séance Musculation 2', 'description' => 'Séance de musculation axée sur la force', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 2],
                    ['nom' => 'Séance Musculation 3', 'description' => 'Séance de musculation pour l’hypertrophie', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 3],
                    ['nom' => 'Séance Musculation 4', 'description' => 'Séance de musculation axée sur la puissance', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 4],
                ]
            ],
            [
                'programme_entrainement_id' => 4, 
                'seances' => [
                    ['nom' => 'Séance Musculation 1', 'description' => 'Séance de musculation axée sur les bras', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 1],
                    ['nom' => 'Séance Musculation 2', 'description' => 'Séance de musculation pour le bas du corps', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 2],
                    ['nom' => 'Séance Musculation 3', 'description' => 'Séance de musculation pour le torse', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 3],
                    ['nom' => 'Séance Musculation 4', 'description' => 'Séance de musculation avec poids libres', 'duree' => '1h', 'chronometre' => 'Non', 'ordre' => 4],
                ]
            ],
            [
                'programme_entrainement_id' => 5, 
                'seances' => [
                    ['nom' => 'Séance Fitness 1', 'description' => 'Séance de fitness pour maintenir la santé', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 1],
                    ['nom' => 'Séance Fitness 2', 'description' => 'Séance de fitness combinant cardio et renforcement musculaire', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 2],
                    ['nom' => 'Séance Fitness 3', 'description' => 'Séance de fitness pour la flexibilité et la mobilité', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 3],
                    ['nom' => 'Séance Fitness 4', 'description' => 'Séance de fitness avec circuit d’entraînement', 'duree' => '1h', 'chronometre' => 'Oui', 'ordre' => 4],
                ]
            ],
            // Ajoutez d'autres programmes et leurs séances ici...
        ];

        // Parcourir chaque programme et insérer les séances correspondantes
        foreach ($programmes as $programme) {
            foreach ($programme['seances'] as $seance) {
                SeanceEntrainement::create([
                    'programme_entrainement_id' => $programme['programme_entrainement_id'],
                    'nom' => $seance['nom'],
                    'description' => $seance['description'],
                    'duree' => $seance['duree'],
                    'chronometre' => $seance['chronometre'],
                    'ordre' => $seance['ordre'],
                ]);
            }
        }
    }
}
