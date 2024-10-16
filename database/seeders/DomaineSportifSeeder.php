<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomaineSportifSeeder extends Seeder
{
    public function run()
    {
        $domaines = [
            [
                'nom' => 'Musculation',
                'description' => 'Entraînement axé sur le développement musculaire.',
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
                'user_id' => 1, 
            ],
            [
                'nom' => 'Cardio',
                'description' => 'Entraînement pour améliorer l’endurance cardiovasculaire.',
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
                'user_id' => 1, // Idem
            ],
            // Ajoutez d'autres domaines selon vos besoins
        ];

        DB::table('domaine_sportifs')->insert($domaines);
        $this->command->info('DomaineSportifSeeder has seeded the domaine_sportifs table!');
    }
}
