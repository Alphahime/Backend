<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RessourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ressources')->insert([
            [
                'type_ressource' => 'Article',
                'titre' => 'Les bienfaits du sport',
                'description' => 'Un article détaillant les nombreux avantages du sport pour la santé.',
                'lien' => 'https://www.lesbienfaitsdusport.com',
                'image' => 'https://www.freepik.com/premium-photo/sports-benefits-image_10001790.htm', 
                'video' => null,
                'domaine_sportif_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_ressource' => 'Vidéo',
                'titre' => 'Entraînement pour débutants',
                'description' => 'Une vidéo expliquant les bases de l’entraînement pour les débutants.',
                'lien' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'image' => null,
                'video' => 'https://example.com/videos/entrainement.mp4', 
                'domaine_sportif_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_ressource' => 'Webinaire',
                'titre' => 'Nutrition pour les sportifs',
                'description' => 'Un webinaire sur l’importance de la nutrition dans le sport.',
                'lien' => 'https://www.exemple.com/nutrition-pour-sportifs',
                'image' => 'https://www.freepik.com/premium-photo/nutrition-image_20001790.htm', // Freepik example
                'video' => null,
                'domaine_sportif_id' => 1,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
      
        ]);
    }
}
