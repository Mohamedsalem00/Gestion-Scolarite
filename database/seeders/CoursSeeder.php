<?php

namespace Database\Seeders;

use App\Models\Cours;
use App\Models\Classe;
use App\Models\Enseignant;
use App\Models\Matiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all teacher-subject-class assignments
        $assignments = DB::table('enseignant_matiere_classe')
                         ->where('enseignant_matiere_classe.active', true)
                         ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
                         ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
                         ->join('enseignants', 'enseignant_matiere_classe.id_enseignant', '=', 'enseignants.id_enseignant')
                         ->select(
                             'enseignant_matiere_classe.id_enseignant',
                             'enseignant_matiere_classe.id_matiere',
                             'enseignant_matiere_classe.id_classe',
                             'matieres.nom_matiere',
                             'classes.nom_classe'
                         )
                         ->get();

        if ($assignments->isEmpty()) {
            $this->command->warn('No teacher-subject-class assignments found. Run EnseignantMatiereClasseSeeder first.');
            return;
        }

        $this->command->info("Creating courses from {$assignments->count()} teacher assignments...");

        foreach ($assignments as $assignment) {
            // Create multiple course sessions per week for each assignment
            $weeklySchedules = $this->getWeeklySchedule();
            
            foreach ($weeklySchedules as $schedule) {
                Cours::create([
                    'id_matiere' => $assignment->id_matiere,
                    'description' => "Cours de {$assignment->nom_matiere} pour la classe {$assignment->nom_classe}",
                    'id_classe' => $assignment->id_classe,
                    'id_enseignant' => $assignment->id_enseignant,
                    'jour' => $schedule['jour'],
                    'date_debut' => $schedule['date_debut'],
                    'date_fin' => $schedule['date_fin'],
                ]);
            }
        }

        $coursCount = Cours::count();
        $this->command->info("Created {$coursCount} course sessions.");
    }

    private function getWeeklySchedule(): array
    {
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
        $heuresDebut = ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00'];
        
        // Create 1-2 sessions per week for each subject
        $schedules = [];
        $sessionCount = rand(1, 2);
        
        for ($i = 0; $i < $sessionCount; $i++) {
            // Avoid duplicate days for the same subject
            $availableJours = array_diff($jours, array_column($schedules, 'jour'));
            if (empty($availableJours)) {
                break;
            }
            
            $jour = $availableJours[array_rand($availableJours)];
            $dateDebut = $heuresDebut[array_rand($heuresDebut)];
            
            // Add 1 hour to start time for end time  
            $dateFin = date('H:i', strtotime($dateDebut . ' +1 hour'));
            
            $schedules[] = [
                'jour' => $jour,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
            ];
        }
        
        return $schedules;
    }
}
