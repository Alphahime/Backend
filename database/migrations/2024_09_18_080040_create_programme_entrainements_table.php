<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammeEntrainementsTable extends Migration
{
    public function up()
    {
        Schema::create('programme_entrainements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coaching_id')->constrained('coachings')->onDelete('cascade');
            $table->foreignId('domaine_sportif_id')->constrained('domaine_sportifs')->onDelete('cascade');
            $table->string('nom');
            $table->text('description');
            $table->string('duree');
            $table->string('frequence');
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->timestamps();
            $table->string('niveau_difficulte')->nullable(); // Ajouté
            $table->string('status')->default('inactive'); // Ajouté
            $table->string('type_programme')->nullable(); // Ajouté
        });
    }

    public function down()
    {
        Schema::dropIfExists('programme_entrainements');
    }
}
