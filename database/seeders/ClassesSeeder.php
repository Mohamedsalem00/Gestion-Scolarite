<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            // Primaire
            ['nom_classe' => 'CP1', 'niveau' => 1],
            ['nom_classe' => 'CP2', 'niveau' => 2],
            ['nom_classe' => 'CE1', 'niveau' => 3],
            ['nom_classe' => 'CE2', 'niveau' => 4],
            ['nom_classe' => 'CM1', 'niveau' => 5],
            ['nom_classe' => 'CM2', 'niveau' => 6],
            
            // Collège
            ['nom_classe' => '6ème A', 'niveau' => 7],
            ['nom_classe' => '6ème B', 'niveau' => 7],
            ['nom_classe' => '5ème A', 'niveau' => 8],
            ['nom_classe' => '5ème B', 'niveau' => 8],
            ['nom_classe' => '4ème A', 'niveau' => 9],
            ['nom_classe' => '4ème B', 'niveau' => 9],
            ['nom_classe' => '3ème A', 'niveau' => 10],
            ['nom_classe' => '3ème B', 'niveau' => 10],
            
            // Lycée
            ['nom_classe' => '2nde A', 'niveau' => 11],
            ['nom_classe' => '2nde B', 'niveau' => 11],
            ['nom_classe' => '1ère L', 'niveau' => 12],
            ['nom_classe' => '1ère S', 'niveau' => 12],
            ['nom_classe' => 'Terminale L', 'niveau' => 13],
            ['nom_classe' => 'Terminale S', 'niveau' => 13],
        ];

        foreach ($classes as $classe) {
            Classe::create($classe);
        }
    }
}
