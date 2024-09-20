<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiviSeancesTable extends Migration
{
    public function up()
    {
        Schema::create('suivi_seances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_entrainement_id')->constrained('programme_entrainements')->onDelete('cascade');
            $table->foreignId('seance_entrainement_id')->constrained('seance_entrainements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suivi_seances');
    }
}
