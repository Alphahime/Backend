<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Ajoute la colonne user_id avec une contrainte de clé étrangère
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Supprime la colonne user_id si elle existe
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
