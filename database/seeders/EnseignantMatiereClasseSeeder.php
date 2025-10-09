<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Matiere;
use App\Models\Classe;

class EnseignantMatiereClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get teachers, subjects, and classes
        $teachers = User::where('role', 'enseignant')->get();
        $matieres = Matiere::all();
        $classes = Classe::all();

        if ($teachers->isEmpty() || $matieres->isEmpty() || $classes->isEmpty()) {
            $this->command->warn('Missing data: Teachers, Matieres, or Classes. Make sure to seed them first.');
            return;
        }

        // Sample assignments - you can customize these based on your needs
        $assignments = [
            // Teacher 1 - Assign multiple subjects to multiple classes
            [
                'teacher_email' => 'elmoctar@ecole.com',
                'subjects' => ['MATH', 'PHY'], // Mathématiques and Sciences Physiques
                'classes' => ['CP1', 'CP2']
            ],
            // You can add more teachers here
        ];

        foreach ($assignments as $assignment) {
            $teacher = $teachers->where('email', $assignment['teacher_email'])->first();
            
            if (!$teacher) {
                $this->command->warn("Teacher with email {$assignment['teacher_email']} not found.");
                continue;
            }

            foreach ($assignment['subjects'] as $subjectCode) {
                $matiere = $matieres->where('code_matiere', $subjectCode)->first();
                
                if (!$matiere) {
                    $this->command->warn("Subject with code {$subjectCode} not found.");
                    continue;
                }

                foreach ($assignment['classes'] as $className) {
                    $classe = $classes->where('nom_classe', $className)->first();
                    
                    if (!$classe) {
                        $this->command->warn("Class {$className} not found.");
                        continue;
                    }

                    // Find the corresponding enseignant record
                    $enseignant = \App\Models\Enseignant::where('email', $teacher->email)->first();
                    
                    if (!$enseignant) {
                        $this->command->warn("Enseignant record not found for teacher {$teacher->name}");
                        continue;
                    }

                    // Insert the assignment if it doesn't exist
                    DB::table('enseignant_matiere_classe')->insertOrIgnore([
                        'id_enseignant' => $enseignant->id_enseignant,
                        'id_matiere' => $matiere->id_matiere,
                        'id_classe' => $classe->id_classe,
                        'active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $this->command->info("Assigned {$teacher->name} to teach {$matiere->nom_matiere} in {$classe->nom_classe}");
                }
            }
        }

        // Auto-assign remaining teachers to random subjects and classes (optional)
        $enseignants = \App\Models\Enseignant::all();
        $unassignedTeachers = $teachers->filter(function ($teacher) use ($enseignants) {
            $enseignant = $enseignants->where('email', $teacher->email)->first();
            if (!$enseignant) return false;
            
            return DB::table('enseignant_matiere_classe')
                     ->where('id_enseignant', $enseignant->id_enseignant)
                     ->count() === 0;
        });

        foreach ($unassignedTeachers as $teacher) {
            $enseignant = $enseignants->where('email', $teacher->email)->first();
            if (!$enseignant) continue;
            
            // Assign 2-3 random subjects to 1-2 random classes
            $randomMatieres = $matieres->random(min(3, $matieres->count()));
            $randomClasses = $classes->random(min(2, $classes->count()));

            foreach ($randomMatieres as $matiere) {
                foreach ($randomClasses as $classe) {
                    DB::table('enseignant_matiere_classe')->insertOrIgnore([
                        'id_enseignant' => $enseignant->id_enseignant,
                        'id_matiere' => $matiere->id_matiere,
                        'id_classe' => $classe->id_classe,
                        'active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $this->command->info("Auto-assigned {$teacher->name} to teach {$matiere->nom_matiere} in {$classe->nom_classe}");
                }
            }
        }

        $totalAssignments = DB::table('enseignant_matiere_classe')->count();
        $this->command->info("Total teacher-subject-class assignments created: {$totalAssignments}");
    }
}
