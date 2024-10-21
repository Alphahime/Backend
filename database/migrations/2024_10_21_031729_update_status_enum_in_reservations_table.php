<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class UpdateStatusEnumInReservationsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE reservations MODIFY status ENUM('en_attente', 'confirme', 'termine')");
    }

    public function down()
    {
        DB::statement("ALTER TABLE reservations MODIFY status ENUM('pending', 'confirmed', 'completed')");
    }
}
