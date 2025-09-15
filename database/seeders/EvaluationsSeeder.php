<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Cours;
use App\Models\Classe;
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
        $courses = Cours::with(['classe', 'enseignant'])->get();

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
                    'matiere' => $cours->matiere,
                    'type' => $evaluationType,
                    'date' => $date,
                    'date_debut' => $evaluationDates['date_debut'],
                    'date_fin' => $evaluationDates['date_fin'],
                    'id_classe' => $cours->id_classe,
                ]);
            }
        }

        // Additional upcoming evaluations could be added here if needed
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
        // For simplicity, use the same date for date_debut and date_fin
        // In reality, these would be the period during which the evaluation takes place
        return [
            'date_debut' => $date,
            'date_fin' => $date,
        ];
    }
}
