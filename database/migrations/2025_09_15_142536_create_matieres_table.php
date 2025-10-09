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
        Schema::create('matieres', function (Blueprint $table) {
            $table->id('id_matiere');
            $table->string('nom_matiere');
            $table->string('code_matiere')->unique();
            $table->text('description')->nullable();
            $table->integer('coefficient')->default(1);
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->index('code_matiere');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
