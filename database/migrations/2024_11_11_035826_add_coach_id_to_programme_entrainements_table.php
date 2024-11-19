<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('programme_entrainements', function (Blueprint $table) {
            $table->foreignId('coach_id')->nullable()->constrained('coaches')->onDelete('cascade');
        });
    }

public function down()
{
    Schema::table('programme_entrainements', function (Blueprint $table) {
        $table->dropForeign(['coach_id']);
        $table->dropColumn('coach_id');
    });
}
};
