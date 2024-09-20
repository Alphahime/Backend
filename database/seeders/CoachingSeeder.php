<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CoachingSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->first();

        if (!$user) {
            $this->command->error('No users found in the database. Please add a user first.');
            return;
        }

        DB::table('coachings')->insert([
            [
                'nom' => 'Coaching de vie',
                'description' => 'Accompagnement personnalisé pour améliorer la qualité de vie.',
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Coaching sportif',
                'description' => 'Suivi sportif intensif pour atteindre des objectifs physiques.',
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
