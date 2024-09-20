<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomaineSportifsTable extends Migration
{
    public function up()
    {
        Schema::create('domaine_sportifs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domaine_sportifs');
    }
}
