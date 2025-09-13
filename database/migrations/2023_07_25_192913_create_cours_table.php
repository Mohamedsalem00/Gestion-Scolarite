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
        Schema::create('cours', function (Blueprint $table) {
            $table->id('id_cours');
            $table->enum('jour', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']);
            $table->time('date_debut'); // Use proper time type
            $table->time('date_fin'); // Use proper time type
            $table->unsignedBigInteger('id_enseignant'); // Clé étrangère pour la table Enseignant
            $table->string('matiere');
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants');
            $table->foreign('id_classe')->references('id_classe')->on('classes');
            
            $table->index(['id_enseignant', 'id_classe']);
            $table->index('jour');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
