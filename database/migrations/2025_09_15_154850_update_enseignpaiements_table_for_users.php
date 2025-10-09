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
        // First truncate the enseignpaiements table to avoid foreign key issues  
        \DB::table('enseignpaiements')->truncate();
        
        Schema::table('enseignpaiements', function (Blueprint $table) {
            // Add user_id column for teacher reference
            $table->unsignedBigInteger('user_id')->after('id_paiements');
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Drop old enseignant reference
            $table->dropForeign(['id_enseignant']);
            $table->dropColumn('id_enseignant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignpaiements', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Remove user_id column
            $table->dropColumn('user_id');
            
            // Add back old enseignant reference
            $table->unsignedBigInteger('id_enseignant');
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants');
        });
    }
};
