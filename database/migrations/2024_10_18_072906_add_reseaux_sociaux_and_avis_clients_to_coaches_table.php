<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->json('reseaux_sociaux')->nullable()->after('disponibilites');
            $table->json('avis_clients')->nullable()->after('reseaux_sociaux');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->dropColumn('reseaux_sociaux');
            $table->dropColumn('avis_clients');
        });
    }
};
