<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIngredientsEtapesImageToPlanNutritionnelsTable extends Migration
{
    public function up()
    {
        Schema::table('plan_nutritionnels', function (Blueprint $table) {
            $table->json('ingredients')->nullable(); // New field for ingredients
            $table->json('etapes')->nullable(); // New field for etapes
            $table->string('image')->nullable(); // New field for image
        });
    }

    public function down()
    {
        Schema::table('plan_nutritionnels', function (Blueprint $table) {
            $table->dropColumn(['ingredients', 'etapes', 'image']);
        });
    }
}
