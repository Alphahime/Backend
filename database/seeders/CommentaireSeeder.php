<?php


namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\User;
use App\Models\Article;
use App\Models\Blog;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        // Vérifie s'il y a des utilisateurs dans la base de données
        $userCount = User::count();

        if ($userCount === 0) {
            // Crée un utilisateur par défaut si aucun n'existe
            $user = User::create([
                'nom' => 'Alpha',
                'prenom' => 'Ndiaye',
                'email' => 'alpha@example.com',
                'mot_de_passe' => bcrypt('password'),
                'telephone' => '123456789',
                'localisation' => 'Dakar, Sénégal',
                'photo_profil' => null, // Met à null s'il n'y a pas de photo
            ]);
        } else {
            // Récupère un utilisateur aléatoire existant
            $user = User::inRandomOrder()->first();
        }

        // Vérifie s'il y a des articles dans la base de données
        $articleCount = Article::count();

        if ($articleCount === 0) {
            // Crée un article par défaut si aucun n'existe
            $article = Article::create([
                'nom' => 'Article Test', // Change 'titre' en 'nom'
                'description' => 'Contenu de test pour l\'article.',
                'type_article' => 'test', // Ajoute des champs supplémentaires si nécessaire
            ]);
        } else {
            // Récupère un article aléatoire existant
            $article = Article::inRandomOrder()->first();
        }

        // Vérifie s'il y a des blogs dans la base de données
        $blogCount = Blog::count();

        if ($blogCount === 0) {
            // Crée un blog par défaut si aucun n'existe
            $blog = Blog::create([
                'nom' => 'Blog Test', // Change 'titre' en 'nom'
                // Enlève 'description' car cette colonne n'existe pas dans la migration
            ]);
        } else {
            // Récupère un blog aléatoire existant
            $blog = Blog::inRandomOrder()->first();
        }

        // Crée un commentaire associé à l'utilisateur, à l'article et au blog
        Commentaire::create([
            'contenu' => 'Ceci est un commentaire de test.',
            'user_id' => $user->id,
            'article_id' => $article->id,
            'blog_id' => $blog->id,
        ]);
    }
}
