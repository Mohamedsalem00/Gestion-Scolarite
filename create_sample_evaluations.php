<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Evaluation;
use App\Models\Classe;

$classe = Classe::first();
if ($classe) {
    echo "Found class: " . $classe->nom_classe . PHP_EOL;
    
    $evaluations = [
        [
            'matiere' => 'Mathématiques',
            'date' => '2025-09-10',
            'type' => 'devoir',
            'date_debut' => '2025-09-10',
            'date_fin' => '2025-09-11',
            'id_classe' => $classe->id_classe,
            'note_max' => 20.00
        ],
        [
            'matiere' => 'Français',
            'date' => '2025-09-12',
            'type' => 'examen',
            'date_debut' => '2025-09-12',
            'date_fin' => '2025-09-13',
            'id_classe' => $classe->id_classe,
            'note_max' => 20.00
        ],
        [
            'matiere' => 'Education Civique',
            'date' => '2025-09-14',
            'type' => 'controle',
            'date_debut' => '2025-09-14',
            'date_fin' => '2025-09-15',
            'id_classe' => $classe->id_classe,
            'note_max' => 20.00
        ]
    ];
    
    foreach ($evaluations as $evalData) {
        $existing = Evaluation::where('matiere', $evalData['matiere'])
                               ->where('id_classe', $evalData['id_classe'])
                               ->where('type', $evalData['type'])
                               ->first();
        
        if (!$existing) {
            Evaluation::create($evalData);
            echo "Created evaluation: " . $evalData['matiere'] . " - " . $evalData['type'] . PHP_EOL;
        } else {
            echo "Evaluation already exists: " . $evalData['matiere'] . " - " . $evalData['type'] . PHP_EOL;
        }
    }
    
    echo "Total evaluations: " . Evaluation::count() . PHP_EOL;
} else {
    echo "No classes found" . PHP_EOL;
}
