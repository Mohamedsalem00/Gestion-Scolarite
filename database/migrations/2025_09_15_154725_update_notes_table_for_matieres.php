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
        // First truncate the notes table to avoid foreign key issues
        \DB::table('notes')->truncate();
        
        Schema::table('notes', function (Blueprint $table) {
            // Add matiere reference - notes will get matiere from evaluation
            $table->unsignedBigInteger('id_matiere')->after('id_note');
            
            // Add foreign key constraint
            $table->foreign('id_matiere')->references('id_matiere')->on('matieres')->onDelete('cascade');
            
            // Remove redundant matiere string column
            $table->dropColumn('matiere');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['id_matiere']);
            
            // Remove new column
            $table->dropColumn('id_matiere');
            
            // Add back old column
            $table->string('matiere');
        });
    }
};
