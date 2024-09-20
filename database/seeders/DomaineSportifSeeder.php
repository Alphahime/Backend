<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DomaineSportifSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->first();
        if (!$user) {
            $this->command->error('No users found in the database. Please add a user first.');
            return;
        }

        $userId = $user->id;

        $domaines = [
            [
                'nom' => 'Musculation',
                'description' => 'Entraînement axé sur le renforcement musculaire et la croissance des muscles.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'user_id' => $userId,
            ],
            [
                'nom' => 'Fitness',
                'description' => 'Programme visant à améliorer la forme physique générale et le bien-être.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'user_id' => $userId,
            ],
            [
                'nom' => 'Préparation Physique',
                'description' => 'Entraînement spécifique pour améliorer les performances physiques dans divers sports.',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'user_id' => $userId,
            ],
        ];

        DB::table('domaine_sportifs')->insert($domaines);
    }
}
