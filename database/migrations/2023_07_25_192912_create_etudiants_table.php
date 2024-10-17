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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('id_etudiant');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('telephone');
            $table->string('adresse');
            $table->unsignedBigInteger('id_classe'); // Clé étrangère pour la table Classe
            $table->timestamps();
            $table->foreign('id_classe')->references('id_classe')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
