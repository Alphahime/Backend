<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ressources')->insert([
            [
                'type_ressource' => 'Article',
                'titre' => 'Les bienfaits du sport',
                'description' => 'Un article détaillant les nombreux avantages du sport pour la santé.',
                'lien' => 'https://example.com/les-bienfaits-du-sport',
                'image' => 'bienfaits_sport.jpg',
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
                'lien' => 'https://example.com/entrainement-debutants',
                'image' => null, 
                'video' => 'entrainement.mp4', 
                'domaine_sportif_id' => 2,
                'user_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
