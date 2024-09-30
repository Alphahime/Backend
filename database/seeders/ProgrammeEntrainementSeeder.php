<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProgrammeEntrainementSeeder extends Seeder
{
    public function run(): void
    {
        $domaineIds = DB::table('domaine_sportifs')->pluck('id');
        $categoryIds = DB::table('categories')->pluck('id');
        $coachingIds = DB::table('coachings')->pluck('id');

        if ($domaineIds->isEmpty() || $categoryIds->isEmpty() || $coachingIds->isEmpty()) {
            $this->command->error('One or more required tables are empty.');
            return;
        }

        DB::table('programme_entrainements')->insert([
            // Programmes de musculation
            [
                'nom' => 'Programme Musculation Force Pure',
                'description' => 'Programme de musculation axé sur le développement de la force maximale.',
                'duree' => '10 semaines',
                'frequence' => '5 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Musculation Hypertrophie',
                'description' => 'Programme de musculation ciblant la croissance musculaire et l\'hypertrophie.',
                'duree' => '12 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'en ligne',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Musculation Prise de Masse',
                'description' => 'Programme conçu pour ceux qui souhaitent augmenter leur masse musculaire.',
                'duree' => '14 semaines',
                'frequence' => '3 fois par semaine',
                'niveau_difficulte' => 'Débutant',
                'type_programme' => 'présentiel',
                'status' => 'inactif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],

            // Programmes de fitness
            [
                'nom' => 'Fitness Cardio-Brûleur',
                'description' => 'Programme de fitness intensif conçu pour brûler les graisses et améliorer l\'endurance.',
                'duree' => '8 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'en ligne',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Fitness Tonification',
                'description' => 'Programme de tonification conçu pour sculpter et raffermir les muscles.',
                'duree' => '6 semaines',
                'frequence' => '3 fois par semaine',
                'niveau_difficulte' => 'Débutant',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Fitness High-Intensity Interval Training (HIIT)',
                'description' => 'Programme HIIT conçu pour des séances rapides et intenses de fitness.',
                'duree' => '4 semaines',
                'frequence' => '5 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],

            // Programmes de préparation physique
            [
                'nom' => 'Préparation Physique Athlète',
                'description' => 'Programme de préparation physique intensif pour les athlètes de haut niveau.',
                'duree' => '16 semaines',
                'frequence' => '6 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Préparation Physique Rugby',
                'description' => 'Programme de préparation physique spécialisé pour les joueurs de rugby.',
                'duree' => '10 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Préparation Physique Football',
                'description' => 'Programme conçu pour améliorer l\'endurance et la force des joueurs de football.',
                'duree' => '12 semaines',
                'frequence' => '5 fois par semaine',
                'niveau_difficulte' => 'Intermédiaire',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'categorie_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
        ]);
    }
}
