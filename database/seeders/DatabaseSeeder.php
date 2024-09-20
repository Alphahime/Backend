<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DomaineSportifSeeder::class,
            ProgrammeEntrainementSeeder::class,
            RessourceSeeder::class,
            SeanceEntrainementSeeder::class,
            SuiviSeanceSeeder::class,
            MessageSeeder::class,
            ArticleSeeder::class,
            BlogSeeder::class,
            CategorieSeeder::class,
            PlanNutritionnelSeeder::class,  
            CoachingSeeder::class,
        ]);
    }
}
