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
        Schema::table('enseignant_matiere_classe', function (Blueprint $table) {
            // First truncate to avoid foreign key issues
            \DB::table('enseignant_matiere_classe')->truncate();
            
            // Add id_enseignant column
            $table->unsignedBigInteger('id_enseignant')->after('id');
            
            // Drop old foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            
            // Add new foreign key
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('cascade');
            
            // Update unique constraint
            $table->dropUnique('unique_enseignant_matiere_classe');
            $table->unique(['id_enseignant', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignant_matiere_classe', function (Blueprint $table) {
            // Drop new foreign key and column
            $table->dropForeign(['id_enseignant']);
            $table->dropColumn('id_enseignant');
            
            // Add back user_id
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Restore unique constraint
            $table->dropUnique('unique_enseignant_matiere_classe');
            $table->unique(['user_id', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
        });
    }
};
