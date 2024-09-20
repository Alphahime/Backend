<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous que l'utilisateur existe, sinon créez-en un pour les messages
        $userId = DB::table('users')->first()->id; 

     
        Message::create([
            'contenu' => 'Bienvenue dans notre plateforme!',
            'statut_lecture' => 'non lu',
            'date_envoie' => now(),
            'user_id' => $userId 
        ]);

        Message::create([
            'contenu' => 'Votre abonnement a été activé.',
            'statut_lecture' => 'lu',
            'date_envoie' => now()->subDay(),
            'date_mise_a_jour' => now(),
            'user_id' => $userId 
        ]);
    }
}
