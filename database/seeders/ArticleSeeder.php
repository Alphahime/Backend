<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Importation du modèle User

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::first(); 

        if ($user) {
            DB::table('articles')->insert([
                [
                    'nom' => 'Les bienfaits du sport',
                    'description' => 'Un article détaillant les nombreux avantages du sport pour la santé.',
                    'type_article' => 'Article',
                    'user_id' => $user->id, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Entraînement pour débutants',
                    'description' => 'Un guide pour les débutants afin de bien démarrer leur entraînement.',
                    'type_article' => 'Guide',
                    'user_id' => $user->id, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        } else {
            $this->command->error('Aucun utilisateur trouvé. Veuillez d\'abord créer un utilisateur.');
        }
    }
}
