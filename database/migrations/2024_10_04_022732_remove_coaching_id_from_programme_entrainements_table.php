<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCoachingIdFromProgrammeEntrainementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->dropColumn('coaching_id');
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
            $table->unsignedBigInteger('coaching_id')->nullable(); // or whatever constraints are needed
        });
    }
}
