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
        Schema::create('etudepaiements', function (Blueprint $table) {
            $table->id('id_paiements');
            $table->unsignedBigInteger('id_etudiant'); // Clé étrangère pour la table Etudiant
            $table->string('typepaye'); // Match model fillable
            $table->decimal('montant', 10, 2)->default(0);
            $table->enum('statut', ['paye', 'non_paye', 'partiel'])->default('non_paye');
            $table->date('date_paiement')->nullable();
            $table->timestamps();
    
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants');
            $table->index('id_etudiant');
            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudepaiements');
    }
};
