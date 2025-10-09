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
            $table->decimal('note', 5, 2); // Proper decimal for grades
            $table->string('matiere'); // Subject name
            $table->string('type'); // Type of evaluation
            $table->unsignedBigInteger('id_etudiant'); // Clé étrangère pour la table Etudiant
            $table->unsignedBigInteger('id_evaluation'); // Fixed reference to evaluations
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->text('commentaire')->nullable();
            $table->timestamps();
    
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants');
            $table->foreign('id_evaluation')->references('id_evaluation')->on('evaluations');
            $table->foreign('id_classe')->references('id_classe')->on('classes');
            
            $table->index(['id_etudiant', 'id_evaluation']);
            $table->index('id_classe');
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
