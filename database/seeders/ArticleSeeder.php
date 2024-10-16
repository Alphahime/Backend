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
        // Récupérer le premier utilisateur
        $user = User::first(); 

        if ($user) {
            DB::table('articles')->insert([
                [
                    'nom' => 'Les bienfaits du sport',
                    'description' => 'Un article détaillant les nombreux avantages du sport pour la santé.',
                    'type_article' => 'Article',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Entraînement pour débutants',
                    'description' => 'Un guide pour les débutants afin de bien démarrer leur entraînement.',
                    'type_article' => 'Guide',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Nutrition et santé',
                    'description' => 'Les bases de la nutrition pour une vie plus saine.',
                    'type_article' => 'Blog',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Méditation pour le bien-être',
                    'description' => 'Comment la méditation peut améliorer votre bien-être mental.',
                    'type_article' => 'Article',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Programme de fitness avancé',
                    'description' => 'Un programme avancé pour ceux qui souhaitent aller plus loin dans leur entraînement.',
                    'type_article' => 'Programme',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Yoga pour débutants',
                    'description' => 'Les bases du yoga pour ceux qui commencent.',
                    'type_article' => 'Guide',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'L’importance du sommeil',
                    'description' => 'Pourquoi bien dormir est crucial pour la santé.',
                    'type_article' => 'Blog',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Cardio et perte de poids',
                    'description' => 'Comment le cardio peut aider à la perte de poids.',
                    'type_article' => 'Article',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'Équipements de sport essentiels',
                    'description' => 'Les équipements de base nécessaires pour commencer à s’entraîner.',
                    'type_article' => 'Guide',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'L’alimentation post-entraînement',
                    'description' => 'Comment bien manger après un entraînement intense.',
                    'type_article' => 'Article',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nom' => 'La musculation pour tous',
                    'description' => 'Un guide pour introduire la musculation dans votre routine.',
                    'type_article' => 'Blog',
                    'user_id' => $user->id,
                    'image' => 'https://via.placeholder.com/150', // Ajout d'une image placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        } else {
            $this->command->error('Aucun utilisateur trouvé. Veuillez d\'abord créer un utilisateur.');
        }
    }
}
