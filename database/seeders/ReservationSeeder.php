<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::create([
            'user_id' => 1, 
            'date_seance' => Carbon::now()->addDays(1),
            'status' => 'pending',
        ]);
    }
}

