<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Coach;
use Illuminate\Support\Str;

class CoachSeeder extends Seeder
{
    public function run()
    {
        // Assurez-vous que vous avez au moins quelques utilisateurs dans la table users
        $users = User::all();

        foreach ($users as $user) {
            Coach::create([
                'user_id' => $user->id, // Associez le coach à un utilisateur
                'profil_verifie' => rand(0, 1), // 0 ou 1 aléatoirement
                'experience' => Str::random(10) . ' ans d\'expérience', // Exemple d'expérience
                'description' => Str::random(50), // Description aléatoire
                'lieu' => 'Lieu ' . Str::random(5), // Exemple de lieu
                'services' => 'Service ' . Str::random(5), // Exemple de service
                'galerie_photos' => json_encode(['photo1.jpg', 'photo2.jpg']), // Exemples de photos
                'diplomes' => 'Diplôme en ' . Str::random(10), // Exemple de diplôme
                'disponibilites' => 'Disponibilité : ' . now()->addDays(rand(1, 30))->format('d-m-Y'), // Disponibilités aléatoires
            ]);
        }
    }
}
