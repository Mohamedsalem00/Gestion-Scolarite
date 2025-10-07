<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Remove redundant matiere and id_classe columns since we have:
     * - matieres table with proper structure
     * - classes table with proper structure  
     * - enseignant_matiere_classe pivot table for relationships
     */
    public function up(): void
    {
        // Remove redundant columns from users table
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraint first if it exists
            try {
                $table->dropForeign(['id_classe']);
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
            
            // Drop the redundant columns
            if (Schema::hasColumn('users', 'matiere')) {
                $table->dropColumn('matiere');
            }
            if (Schema::hasColumn('users', 'id_classe')) {
                $table->dropColumn('id_classe');
            }
        });

        // Remove redundant columns from enseignants table
        Schema::table('enseignants', function (Blueprint $table) {
            // Drop foreign key constraint first
            try {
                $table->dropForeign(['id_classe']);
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
            
            // Drop the redundant columns
            if (Schema::hasColumn('enseignants', 'matiere')) {
                $table->dropColumn('matiere');
            }
            if (Schema::hasColumn('enseignants', 'id_classe')) {
                $table->dropColumn('id_classe');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the columns if needed (for rollback)
        Schema::table('users', function (Blueprint $table) {
            $table->string('matiere')->nullable();
            $table->unsignedBigInteger('id_classe')->nullable();
            $table->foreign('id_classe')->references('id_classe')->on('classes');
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->string('matiere')->nullable();
            $table->unsignedBigInteger('id_classe')->nullable();
            $table->foreign('id_classe')->references('id_classe')->on('classes');
        });
    }
};
