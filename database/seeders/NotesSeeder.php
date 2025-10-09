<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Evaluation;
use App\Models\Etudiant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluations = Evaluation::with('classe')->get();

        if ($evaluations->isEmpty()) {
            $this->command->warn('No completed evaluations found. Run EvaluationsSeeder first.');
            return;
        }

        foreach ($evaluations as $evaluation) {
            // Get all students from the evaluation's class
            $students = Etudiant::where('id_classe', $evaluation->id_classe)->get();

            foreach ($students as $student) {
                $bareme = 20; // Default scale
                $note = $this->generateRealisticNote($bareme, $evaluation->type);
                
                Note::create([
                    'note' => $note,
                    'id_matiere' => $evaluation->id_matiere,
                    'type' => $evaluation->type,
                    'commentaire' => $this->generateComment($note, $bareme),
                    'id_etudiant' => $student->id_etudiant,
                    'id_evaluation' => $evaluation->id_evaluation,
                    'id_classe' => $evaluation->id_classe,
                ]);
            }
        }
    }

    private function generateRealisticNote(int $bareme, string $evaluationType): float
    {
        // Different grade distributions based on evaluation type
        $distributions = [
            'controle' => [
                'excellent' => 0.10,
                'good' => 0.30,
                'average' => 0.40,
                'below' => 0.20
            ],
            'devoir' => [
                'excellent' => 0.12,
                'good' => 0.28,
                'average' => 0.38,
                'below' => 0.22
            ],
            'examen' => [
                'excellent' => 0.08,
                'good' => 0.22,
                'average' => 0.45,
                'below' => 0.25
            ]
        ];

        $dist = $distributions[$evaluationType] ?? $distributions['controle'];
        $rand = mt_rand() / mt_getrandmax();

        if ($rand < $dist['excellent']) {
            // Excellent: 18-20 or 9-10
            $min = $bareme * 0.90;
            $max = $bareme;
        } elseif ($rand < $dist['excellent'] + $dist['good']) {
            // Good: 14-17 or 7-8.5
            $min = $bareme * 0.70;
            $max = $bareme * 0.89;
        } elseif ($rand < $dist['excellent'] + $dist['good'] + $dist['average']) {
            // Average: 10-13 or 5-6.5
            $min = $bareme * 0.50;
            $max = $bareme * 0.69;
        } else {
            // Below average: 0-9 or 0-4.5
            $min = 0;
            $max = $bareme * 0.49;
        }

        $note = $min + (mt_rand() / mt_getrandmax()) * ($max - $min);
        
        // Round to 0.5 or 1 point precision
        return round($note * 2) / 2;
    }

    private function generateComment(float $note, int $bareme): string
    {
        $percentage = ($note / $bareme) * 100;

        if ($percentage >= 90) {
            $comments = [
                'Excellent travail ! Félicitations.',
                'Très belle performance, continuez ainsi.',
                'Travail exemplaire, bravo !',
                'Résultat remarquable, parfait.',
            ];
        } elseif ($percentage >= 70) {
            $comments = [
                'Bon travail, bien maîtrisé.',
                'Bonne compréhension du sujet.',
                'Travail satisfaisant, continuez.',
                'Bien joué, quelques points à améliorer.',
            ];
        } elseif ($percentage >= 50) {
            $comments = [
                'Travail moyen, peut mieux faire.',
                'Efforts à poursuivre.',
                'Quelques lacunes à combler.',
                'Travail acceptable, à améliorer.',
            ];
        } else {
            $comments = [
                'Travail insuffisant, il faut réviser.',
                'Beaucoup d\'efforts à fournir.',
                'Nécessite plus de travail personnel.',
                'Difficultés importantes, besoin d\'aide.',
            ];
        }

        return $comments[array_rand($comments)];
    }
}
