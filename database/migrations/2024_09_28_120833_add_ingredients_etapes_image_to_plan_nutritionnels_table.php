<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIngredientsEtapesImageToPlanNutritionnelsTable extends Migration
{
    public function up()
    {
        Schema::table('plan_nutritionnels', function (Blueprint $table) {
            $table->json('ingredients')->nullable(); 
            $table->json('etapes')->nullable();
            $table->string('image')->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('plan_nutritionnels', function (Blueprint $table) {
            $table->dropColumn(['ingredients', 'etapes', 'image']);
        });
    }
}
