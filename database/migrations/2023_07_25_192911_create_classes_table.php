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
        Schema::create('classes', function (Blueprint $table) {
            $table->id('id_classe');
            $table->string('nom_classe');
            $table->string('niveau');
            $table->json('nom_classe_translations')->nullable(); // For AR/FR translations
            $table->json('niveau_translations')->nullable(); // For AR/FR translations
            $table->timestamps();
            
            $table->index('niveau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
