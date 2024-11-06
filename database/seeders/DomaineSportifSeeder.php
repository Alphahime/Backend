<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DomaineSportif;

class DomaineSportifSeeder extends Seeder
{
    public function run()
    {
        $domaines = [
            [
                'nom' => 'Musculation',
                'description' => 'Entraînement axé sur le développement musculaire.',
                'user_id' => 1,
            ],
            [
                'nom' => 'Cardio',
                'description' => 'Entraînement pour améliorer l’endurance cardiovasculaire.',
                'user_id' => 1,
            ],
            // Ajoutez d'autres domaines selon vos besoins
        ];

        foreach ($domaines as $domaineData) {
            DomaineSportif::create(array_merge($domaineData, [
                'date_creation' => now(),
                'date_mise_a_jour' => now(),
            ]));
        }
        
        $this->command->info('DomaineSportifSeeder has seeded the domaine_sportifs table!');
    }
}
