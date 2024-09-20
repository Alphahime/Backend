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
            [
                'nom' => 'Programme Musculation Sénégalaise',
                'description' => 'Programme d\'entraînement de musculation adapté aux besoins des sportifs sénégalais.',
                'duree' => '12 semaines',
                'frequence' => '4 fois par semaine',
                'niveau_difficulte' => 'Avancé',
                'type_programme' => 'présentiel',
                'status' => 'actif',
                'domaine_sportif_id' => $domaineIds->random(),
                'category_id' => $categoryIds->random(),
                'coaching_id' => $coachingIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now()
            ],
        ]);
    }
}
