<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PlanNutritionnelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plan_nutritionnels')->insert([
            [
                'nom' => 'Perte de Poids',
                'description' => 'Un plan nutritionnel conçu pour favoriser la perte de poids de manière équilibrée.',
                'type_alimentation' => 'Hypocalorique',
                'calories_totale' => '1500 kcal',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Prise de Masse',
                'description' => 'Un plan nutritionnel pour ceux qui cherchent à augmenter leur masse musculaire.',
                'type_alimentation' => 'Hypercalorique',
                'calories_totale' => '3000 kcal',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ],
            [
                'nom' => 'Maintenance',
                'description' => 'Un plan équilibré pour maintenir le poids actuel tout en optimisant la santé.',
                'type_alimentation' => 'Normocalorique',
                'calories_totale' => '2000 kcal',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
            ]
        ]);
    }
}
