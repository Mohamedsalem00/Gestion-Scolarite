<?php
// Quick test to see students data
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Etudiant;

$etudiants = Etudiant::with('classe')->latest()->get();

echo "Students count: " . $etudiants->count() . "\n";
echo "Students data:\n";

foreach ($etudiants->take(3) as $etudiant) {
    echo "- " . $etudiant->prenom . " " . $etudiant->nom . " (" . $etudiant->email . ")\n";
    echo "  Classe: " . ($etudiant->classe?->nom_classe ?? 'Non assigné') . "\n";
    echo "  Phone: " . ($etudiant->telephone ?? 'N/A') . "\n";
    echo "  Genre: " . ($etudiant->genre ?? 'N/A') . "\n";
    echo "\n";
}
