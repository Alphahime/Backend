<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DomaineSportif;
use App\Models\Categorie;
use Illuminate\Support\Carbon;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = DomaineSportif::all();

        if ($domaines->isEmpty()) {
            $this->command->error('No domaines sportifs found in the database.');
            return;
        }

        $categories = [
            [
                'nom' => 'Homme',
                'description' => 'Catégorie pour les hommes.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Femme',
                'description' => 'Catégorie pour les femmes.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Sportif Confirmé',
                'description' => 'Catégorie pour les sportifs confirmés.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
        ];

        foreach ($categories as $categoryData) {
            $domaine = $domaines->random();
            $category = Categorie::create(array_merge($categoryData, [
                'domaine_sportif_id' => $domaine->id,
            ]));
        }
    }
}
