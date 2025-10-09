<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Cours;
use App\Models\Classe;
use App\Models\User;

// Find a teacher user
$teacher = User::where('role', 'enseignant')->first();
$classe = Classe::first();

if ($teacher && $classe) {
    echo "Found teacher: " . $teacher->name . PHP_EOL;
    echo "Found class: " . $classe->nom_classe . PHP_EOL;
    
    $subjects = ['Mathématiques', 'Français', 'Education Civique'];
    
    foreach ($subjects as $subject) {
        $existing = Cours::where('id_enseignant', $teacher->id)
                         ->where('id_classe', $classe->id_classe)
                         ->where('matiere', $subject)
                         ->first();
        
        if (!$existing) {
            Cours::create([
                'matiere' => $subject,
                'id_enseignant' => $teacher->id,
                'id_classe' => $classe->id_classe
            ]);
            echo "Created course: " . $subject . " for " . $teacher->name . PHP_EOL;
        } else {
            echo "Course already exists: " . $subject . PHP_EOL;
        }
    }
    
    echo "Total courses: " . Cours::count() . PHP_EOL;
} else {
    echo "Teacher or class not found" . PHP_EOL;
    echo "Teachers: " . User::where('role', 'enseignant')->count() . PHP_EOL;
    echo "Classes: " . Classe::count() . PHP_EOL;
}
