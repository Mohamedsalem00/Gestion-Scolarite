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
        Schema::create('enseignant_matiere_classe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Teacher ID from users table
            $table->unsignedBigInteger('id_matiere');
            $table->unsignedBigInteger('id_classe');
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            $table->foreign('id_classe')->references('id_classe')->on('classes')->onDelete('cascade');
            
            // Ensure unique combination
            $table->unique(['user_id', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
            
            // Indexes for better performance
            $table->index('user_id');
            $table->index('id_matiere');
            $table->index('id_classe');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignant_matiere_classe');
    }
};
