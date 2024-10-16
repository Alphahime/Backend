<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgrammeEntrainementIdToSeanceEntrainementsTable extends Migration
{
    public function up()
    {
        Schema::table('seance_entrainements', function (Blueprint $table) {
            $table->unsignedBigInteger('programme_entrainement_id')->nullable(); 
            $table->foreign('programme_entrainement_id')->references('id')->on('programme_entrainements')->onDelete('cascade'); // Si nécessaire, crée la clé étrangère
        });
    }

    public function down()
    {
        Schema::table('seance_entrainements', function (Blueprint $table) {
            $table->dropForeign(['programme_entrainement_id']);
            $table->dropColumn('programme_entrainement_id');
        });
    }
}
