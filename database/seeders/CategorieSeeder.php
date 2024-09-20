<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $domaineIds = DB::table('domaine_sportifs')->pluck('id');

        if ($domaineIds->isEmpty()) {
            $this->command->error('No domaines sportifs found in the database.');
            return;
        }

        $categories = [
            [
                'nom' => 'Homme',
                'description' => 'Catégorie pour les hommes.',
                'domaine_sportif_id' => $domaineIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Femme',
                'description' => 'Catégorie pour les femmes.',
                'domaine_sportif_id' => $domaineIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Sportif Confirmé',
                'description' => 'Catégorie pour les sportifs confirmés.',
                'domaine_sportif_id' => $domaineIds->random(),
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

