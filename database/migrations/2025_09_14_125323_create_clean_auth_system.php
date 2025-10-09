<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add new fields to users table for clean auth (check if columns exist first)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'prenom')) {
                $table->string('prenom')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'nom')) {
                $table->string('nom')->nullable()->after('prenom');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'enseignant'])->default('admin')->after('email');
            }
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'matiere')) {
                $table->string('matiere')->nullable()->after('telephone'); // For teachers
            }
            if (!Schema::hasColumn('users', 'id_classe')) {
                $table->unsignedBigInteger('id_classe')->nullable()->after('matiere'); // For teachers
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('id_classe');
            }
        });

        // Add foreign key constraint if it doesn't exist
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('id_classe')->references('id_classe')->on('classes')->onDelete('set null');
            });
        } catch (\Exception $e) {
            // Foreign key already exists
        }

        // Step 2: Migrate data from administrateurs table (if it exists)
        if (Schema::hasTable('administrateurs')) {
            $administrateurs = DB::table('administrateurs')->get();
            foreach ($administrateurs as $admin) {
                // Check if user already exists
                $existingUser = DB::table('users')->where('email', $admin->email)->first();
                if (!$existingUser) {
                    DB::table('users')->insert([
                        'name' => $admin->prenom . ' ' . $admin->nom,
                        'prenom' => $admin->prenom,
                        'nom' => $admin->nom,
                        'email' => $admin->email,
                        'password' => $admin->mot_de_passe ?? Hash::make('admin123'), // Keep existing or default password
                        'role' => 'admin',
                        'is_active' => true,
                        'created_at' => $admin->created_at ?? now(),
                        'updated_at' => $admin->updated_at ?? now(),
                    ]);
                } else {
                    // Update existing user to admin role
                    DB::table('users')->where('email', $admin->email)->update([
                        'prenom' => $admin->prenom,
                        'nom' => $admin->nom,
                        'role' => 'admin',
                        'is_active' => true,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Step 3: Migrate data from enseignants table (if it exists)
        if (Schema::hasTable('enseignants')) {
            $enseignants = DB::table('enseignants')->get();
            foreach ($enseignants as $enseignant) {
                // Check if user already exists
                $existingUser = DB::table('users')->where('email', $enseignant->email)->first();
                if (!$existingUser) {
                    DB::table('users')->insert([
                        'name' => $enseignant->prenom . ' ' . $enseignant->nom,
                        'prenom' => $enseignant->prenom,
                        'nom' => $enseignant->nom,
                        'email' => $enseignant->email,
                        'password' => Hash::make('password123'), // Default password for teachers
                        'role' => 'enseignant',
                        'telephone' => $enseignant->telephone ?? null,
                        'matiere' => $enseignant->matiere ?? null,
                        'id_classe' => $enseignant->id_classe ?? null,
                        'is_active' => true,
                        'email_verified_at' => now(),
                        'created_at' => $enseignant->created_at ?? now(),
                        'updated_at' => $enseignant->updated_at ?? now(),
                    ]);
                } else {
                    // Update existing user to teacher role with enseignant data
                    DB::table('users')->where('email', $enseignant->email)->update([
                        'name' => $enseignant->prenom . ' ' . $enseignant->nom,
                        'prenom' => $enseignant->prenom,
                        'nom' => $enseignant->nom,
                        'role' => 'enseignant',
                        'telephone' => $enseignant->telephone ?? null,
                        'matiere' => $enseignant->matiere ?? null,
                        'id_classe' => $enseignant->id_classe ?? null,
                        'is_active' => true,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Step 4: Students don't need login accounts - they stay in etudiants table only
        // Remove any existing student users that might have been created by mistake
        DB::table('users')->where('role', 'etudiant')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign key constraint first
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['id_classe']);
            });
        } catch (\Exception $e) {
            // Foreign key doesn't exist
        }

        // Remove the added columns if they exist
        Schema::table('users', function (Blueprint $table) {
            $columns = ['prenom', 'nom', 'role', 'telephone', 'matiere', 'id_classe', 'is_active'];
            $existingColumns = Schema::getColumnListing('users');
            
            foreach ($columns as $column) {
                if (in_array($column, $existingColumns)) {
                    $table->dropColumn($column);
                }
            }
        });
        
        // Remove migrated users (keep only original basic users)
        DB::table('users')->whereIn('role', ['admin', 'enseignant'])->delete();
    }
};
