<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRessourcesTable extends Migration
{
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->string('type_ressource');
            $table->string('titre');
            $table->text('description');
            $table->string('lien');
            $table->string('video')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->foreignId('domaine_sportif_id')->constrained('domaine_sportifs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ressources');
    }
}
