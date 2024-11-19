<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgrammeEntrainement;
use App\Models\Categorie;
use App\Models\DomaineSportif;

class ProgrammeEntrainementSeeder extends Seeder
{
    public function run()
    {
        $categories = Categorie::all();
        $domaines = DomaineSportif::all();

        if ($categories->isEmpty() || $domaines->isEmpty()) {
            $this->command->error('Categories or Domaines Sportifs not found.');
            return;
        }

        $programmes = [
            [
                'nom' => 'Programme Musculation Force Pure',
                'description' => 'Programme de musculation axé sur le développement de la force maximale.',
                'duree' => '10 semaines',
                'frequence' => '5 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'images' => 'https://img.freepik.com/photos-gratuite/homme-athletique-courir-dans-fond-noir_1301-6629.jpg?t=st=1731725478~exp=1731729078~hmac=5b599e10e9833ea002988b20c573979b5714a2e89b076b8a444785888c03304d&w=740',
                'coach_id' => 1,
            ],
            [
                'nom' => 'Programme Cardio Intensif',
                'description' => 'Programme de cardio pour brûler des calories et améliorer l’endurance.',
                'duree' => '8 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'en ligne',
                'status' => 'actif',
                'images' => 'https://img.freepik.com/photos-gratuite/homme-athletique-courir-dans-fond-noir_1301-6629.jpg?t=st=1731725478~exp=1731729078~hmac=5b599e10e9833ea002988b20c573979b5714a2e89b076b8a444785888c03304d&w=740',
                'coach_id' => 1,
            ],
        ];

        foreach ($programmes as $programmeData) {
            ProgrammeEntrainement::create(array_merge($programmeData, [
                'domaine_sportif_id' => $domaines->random()->id,
                'categorie_id' => $categories->random()->id,
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
            ]));
        }

        $this->command->info('ProgrammeEntrainementSeeder a été exécuté avec succès !');
    }
}
