<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Coach;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $userId = 1;
        $coachId = 1; 

        Reservation::create([
            'user_id' => $userId,
            'coach_id' => $coachId,
            'date_seance' => Carbon::now()->addDays(1),
            'status' => 'pending',
        ]);
    }
}

