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
        Schema::create('notes', function (Blueprint $table) {
            $table->id('id_note');
            $table->string('note');
            $table->string('type');
            $table->unsignedBigInteger('id_etudiant'); // Clé étrangère pour la table Etudiant
            $table->unsignedBigInteger('id_evoluation'); // Clé étrangère pour la table Evoluation
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->timestamps();
    
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants');
            $table->foreign('id_evoluation')->references('id_evoluation')->on('evoluations');
            $table->foreign('id_classe')->references('id_classe')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
