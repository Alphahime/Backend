<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanNutritionnelsTable extends Migration
{
    public function up()
    {
        Schema::create('plan_nutritionnels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('type_alimentation');
            $table->string('calories_totale');
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_nutritionnels');
    }
}
