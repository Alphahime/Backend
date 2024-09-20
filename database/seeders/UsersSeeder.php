<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nom' => 'Diop',
                'prenom' => 'Mamadou',
                'mot_de_passe' => Hash::make('password123'),
                'email' => 'mamadou.diop@example.com',
                'photo_profil' => 'photo1.jpg',
                'telephone' => '+221772345678',
                'localisation' => 'Dakar, Sénégal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Sow',
                'prenom' => 'Aissatou',
                'mot_de_passe' => Hash::make('password123'),
                'email' => 'aissatou.sow@example.com',
                'photo_profil' => 'photo2.jpg',
                'telephone' => '+221773456789',
                'localisation' => 'Thiès, Sénégal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Wade',
                'prenom' => 'Ousmane',
                'mot_de_passe' => Hash::make('password123'),
                'email' => 'ousmane.wade@example.com',
                'photo_profil' => 'photo3.jpg',
                'telephone' => '+221774567890',
                'localisation' => 'Saint-Louis, Sénégal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Fall',
                'prenom' => 'Mariam',
                'mot_de_passe' => Hash::make('password123'),
                'email' => 'mariam.fall@example.com',
                'photo_profil' => 'photo4.jpg',
                'telephone' => '+221775678901',
                'localisation' => 'Kaolack, Sénégal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Sy',
                'prenom' => 'Abdoulaye',
                'mot_de_passe' => Hash::make('password123'),
                'email' => 'abdoulaye.sy@example.com',
                'photo_profil' => 'photo5.jpg',
                'telephone' => '+221776789012',
                'localisation' => 'Ziguinchor, Sénégal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
