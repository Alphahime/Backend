<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToProgrammeEntrainementsTable extends Migration
{
    public function up()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->string('images')->nullable(); // Ajoute la colonne images
        });
    }

    public function down()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->dropColumn('images'); 
        });
    }
}
