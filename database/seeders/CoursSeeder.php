<?php

namespace Database\Seeders;

use App\Models\Cours;
use App\Models\Classe;
use App\Models\Enseignant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classe::all();
        $enseignants = Enseignant::all();

        if ($classes->isEmpty() || $enseignants->isEmpty()) {
            $this->command->warn('Classes or enseignants not found. Run ClassesSeeder and EnseignantsSeeder first.');
            return;
        }

        // Define subjects by level
        $subjectsByLevel = [
            'primaire' => [
                'Mathématiques', 'Français', 'Arabe', 'Sciences', 'Histoire-Géographie', 
                'Education Civique', 'Sport', 'Dessin'
            ],
            'college' => [
                'Mathématiques', 'Français', 'Arabe', 'Anglais', 'Sciences Physiques', 
                'Biologie', 'Histoire-Géographie', 'Education Civique', 'Sport', 'Technologie'
            ],
            'lycee' => [
                'Mathématiques', 'Français', 'Arabe', 'Anglais', 'Sciences Physiques', 
                'Biologie', 'Histoire-Géographie', 'Philosophie', 'Sport', 'Economie'
            ]
        ];

        foreach ($classes as $classe) {
            // Determine level category
            $levelCategory = $this->getLevelCategory($classe->niveau);
            $subjects = $subjectsByLevel[$levelCategory];

            foreach ($subjects as $subjectName) {
                // Find appropriate teacher for the subject
                $teacher = $this->findTeacherForSubject($enseignants, $subjectName);
                
                // Get random schedule for this course
                $schedule = $this->getRandomSchedule();
                
                Cours::create([
                    'matiere' => $subjectName,
                    'description' => "Cours de {$subjectName} pour la classe {$classe->nom_classe}",
                    'id_classe' => $classe->id_classe,
                    'id_enseignant' => $teacher?->id_enseignant,
                    'jour' => $schedule['jour'],
                    'date_debut' => $schedule['date_debut'],
                    'date_fin' => $schedule['date_fin'],
                ]);
            }
        }
    }

    private function getLevelCategory(int $niveau): string
    {
        if ($niveau <= 6) {
            return 'primaire';
        } elseif ($niveau <= 10) {
            return 'college';
        } else {
            return 'lycee';
        }
    }

    private function findTeacherForSubject($enseignants, string $subject): ?Enseignant
    {
        // Find teacher by matiere (subject speciality)
        $teacher = $enseignants->where('matiere', $subject)->first();
        
        if ($teacher) {
            return $teacher;
        }

        // Return random teacher as fallback
        return $enseignants->random();
    }

    private function getRandomSchedule(): array
    {
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
        $heuresDebut = ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00'];
        
        $jour = $jours[array_rand($jours)];
        $dateDebut = $heuresDebut[array_rand($heuresDebut)];
        
        // Add 1 hour to start time for end time  
        $dateFin = date('H:i', strtotime($dateDebut . ' +1 hour'));
        
        return [
            'jour' => $jour,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ];
    }
}
