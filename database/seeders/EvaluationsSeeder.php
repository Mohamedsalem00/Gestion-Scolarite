<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Cours;
use App\Models\Classe;
use App\Models\Matiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EvaluationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Cours::with(['classe', 'enseignant', 'matiere'])->get();

        if ($courses->isEmpty()) {
            $this->command->warn('No courses found. Run CoursSeeder first.');
            return;
        }

        // Create evaluations for each course
        foreach ($courses as $cours) {
            // Create 2-3 evaluations per course per semester
            $evaluationsCount = rand(2, 3);
            
            for ($i = 0; $i < $evaluationsCount; $i++) {
                $evaluationType = $this->getRandomEvaluationType();
                $date = $this->getRandomEvaluationDate();
                
                $evaluationDates = $this->getEvaluationDates($date);
                
                Evaluation::create([
                    'id_matiere' => $cours->id_matiere,
                    'titre' => ucfirst($evaluationType) . ' de ' . $cours->matiere->nom_matiere . ' - Séance ' . ($i + 1),
                    'type' => $evaluationType,
                    'date' => $date,
                    'date_debut' => $evaluationDates['date_debut'],
                    'date_fin' => $evaluationDates['date_fin'],
                    'id_classe' => $cours->id_classe,
                    'note_max' => $this->getBaremeForType($evaluationType), // Dynamic maximum note
                ]);
            }
        }

        $evaluationCount = Evaluation::count();
        $this->command->info("Created {$evaluationCount} evaluations.");
    }

    private function getRandomEvaluationType(): string
    {
        $types = ['devoir', 'controle', 'examen'];
        return $types[array_rand($types)];
    }

    private function getRandomEvaluationDate(): Carbon
    {
        // Generate dates from last 3 months
        $startDate = Carbon::now()->subMonths(3);
        $endDate = Carbon::now()->subDays(1);
        
        return Carbon::createFromTimestamp(
            rand($startDate->timestamp, $endDate->timestamp)
        );
    }

    private function getDurationForType(string $type): int
    {
        $durations = [
            'devoir' => 120,      // 2 hours
            'controle' => 60,     // 1 hour
            'examen' => 180,      // 3 hours
            'interrogation' => 30  // 30 minutes
        ];

        return $durations[$type] ?? 60;
    }

    private function getBaremeForType(string $type): int
    {
        $baremes = [
            'devoir' => 20,
            'controle' => 20,
            'examen' => 20,
            'interrogation' => 10
        ];

        return $baremes[$type] ?? 20;
    }

    private function getEvaluationDates($date): array
    {
        // Generate realistic evaluation times
        $startHours = [8, 9, 10, 13, 14, 15]; // Common exam start times
        $startHour = $startHours[array_rand($startHours)];
        $startMinute = [0, 30][array_rand([0, 30])]; // Either :00 or :30
        
        $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);
        
        // Calculate end time based on duration (1-3 hours)
        $duration = rand(1, 3); // hours
        $endHour = $startHour + $duration;
        $endTime = sprintf('%02d:%02d:00', $endHour, $startMinute);
        
        return [
            'date_debut' => $startTime,
            'date_fin' => $endTime,
        ];
    }
}
