<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeanceEntrainementsTable extends Migration
{
    public function up()
    {
        Schema::create('seance_entrainements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('duree');
            $table->string('chronometre')->nullable();
            $table->integer('ordre');
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seance_entrainements');
    }
}
