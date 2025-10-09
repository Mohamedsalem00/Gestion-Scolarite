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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('id_evaluation');
            $table->unsignedBigInteger('id_matiere');
            $table->string('titre')->nullable();
            $table->date('date');
            $table->time('date_debut')->nullable();
            $table->time('date_fin')->nullable();
            $table->unsignedBigInteger('id_classe');
            $table->enum('type', ['devoir', 'examen', 'controle']);
            $table->decimal('note_max', 5, 2)->default(20.00);
            $table->timestamps();
    
            $table->foreign('id_classe')->references('id_classe')->on('classes')->onDelete('cascade');
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            
            $table->index('id_classe');
            $table->index('id_matiere');
            $table->index('date');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
