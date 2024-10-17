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
        Schema::create('enseignpaiements', function (Blueprint $table) {
            $table->id('id_paiements');
            $table->unsignedBigInteger('id_enseignant'); // Clé étrangère pour la table Enseignant
            $table->string('statut');
            $table->timestamps();
    
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignpaiements');
    }
};
