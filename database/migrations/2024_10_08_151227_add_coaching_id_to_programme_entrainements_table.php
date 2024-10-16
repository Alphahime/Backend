<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoachingIdToProgrammeEntrainementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->unsignedBigInteger('coaching_id')->after('categorie_id')->nullable(); // Add coaching_id column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->dropColumn('coaching_id'); 
        });
    }
}
