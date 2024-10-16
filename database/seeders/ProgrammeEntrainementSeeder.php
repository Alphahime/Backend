<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammeEntrainementSeeder extends Seeder
{
    public function run()
    {
        $programmes = [
            [
                'nom' => 'Programme Musculation Force Pure',
                'description' => 'Programme de musculation axé sur le développement de la force maximale.',
                'duree' => '10 semaines',
                'frequence' => '5 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'images' => 'https://www.example.com/path/to/real-image1.jpg', // Remplacez par la vraie URL de l'image
                'domaine_sportif_id' => 7, 
                'categorie_id' => 4, 
                'coaching_id' => 2, 
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
            ],
            [
                'nom' => 'Programme Cardio Intensif',
                'description' => 'Programme de cardio pour brûler des calories et améliorer l’endurance.',
                'duree' => '8 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'en ligne',
                'status' => 'actif',
                'images' => 'https://www.example.com/path/to/real-image2.jpg', // Remplacez par la vraie URL de l'image
                'domaine_sportif_id' => 8,
                'categorie_id' => 5,
                'coaching_id' => 3,
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
            ],
            // Ajoutez d'autres programmes avec des images réelles...
        ];

        DB::table('programme_entrainements')->insert($programmes);
        $this->command->info('ProgrammeEntrainementSeeder a été exécuté avec succès !');
    }
}
