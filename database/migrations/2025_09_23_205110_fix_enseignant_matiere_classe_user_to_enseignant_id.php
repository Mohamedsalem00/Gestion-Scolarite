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
        // The table already has the correct structure with id_enseignant column
        // and proper foreign key relationships from previous migrations
        // This migration is a no-op since the structure is already correct
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignant_matiere_classe', function (Blueprint $table) {
            // Drop the foreign key if it exists
            try {
                $table->dropForeign(['id_enseignant']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
        });
    }
};
