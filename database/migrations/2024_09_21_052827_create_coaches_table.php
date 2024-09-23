<?php

// database/migrations/xxxx_xx_xx_create_coaches_table.php

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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('profil_verifie')->default(false);
            $table->string('experience')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('lieu')->nullable(); 
            $table->json('services')->nullable(); 
            $table->json('galerie_photos')->nullable(); 
            $table->json('diplomes')->nullable(); 
            $table->json('disponibilites')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
