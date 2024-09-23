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
    
        $user = User::create([
            'nom' => 'Alpha',
            'prenom' => 'Ndiaye',
            'email' => 'alpha@example.com',
            'mot_de_passe' => bcrypt('password'),
            'photo_profil' => null,
            'telephone' => '775689908',
            'localisation' => 'Dakar',
        ]);

      
        Coach::create([
            'user_id' => $user->id,
            'profil_verifie' => true,
            'experience' => 'Coach experimenté',
            'description' => 'Coach sportif offrant divers services de fitness.',
            'lieu' => 'Dakar',
            'services' => json_encode([
                'Préparation physique' => [
                    'tarif' => 2500,
                    'description' => 'Amélioration de la condition physique et hygiène de vie.',
                    'duree' => '90 minutes',
                    'nombre_personnes' => 10,
                    'endroit' => 'Endroit proposé par le client',
                ]
            ]),
            'galerie_photos' => json_encode([]), 
            'diplomes' => json_encode([
                [
                    'diplome' => 'Training For Coach And Fitness Players',
                    'institution' => 'The Royal Senegalese Federation of Aerobics , Fitness , and Hip Hop',
                    'date_obtention' => '2016-07-22'
                ]
            ]),
            'disponibilites' => json_encode([
                'Lundi' => '9:00 - 17:00',
                'Mardi' => '9:00 - 17:00',
                
            ])
        ]);
    }
}
