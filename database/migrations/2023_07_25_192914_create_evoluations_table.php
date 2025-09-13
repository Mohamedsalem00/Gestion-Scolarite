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
        Schema::create('evoluations', function (Blueprint $table) {
            $table->id('id_evoluation');
            $table->string('matiere');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->string('type');
            $table->timestamps();
    
            $table->foreign('id_classe')->references('id_classe')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evoluations');
    }
};
