<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Note;
use App\Models\Evaluation;
use App\Models\Cours;

class EtudiantDashboardController extends Controller
{
    /**
     * Show public grade search form
     */
    public function rechercherNotes(Request $request)
    {
        $student = null;
        $notes = collect();
        $stats = null;
        
        if ($request->isMethod('post')) {
            $request->validate([
                'matricule' => 'required|string'
            ]);
            
            // Find student by matricule
            $student = Etudiant::where('matricule', $request->matricule)->first();
            
            if ($student) {
                // Get student's notes
                $notes = Note::where('id_etudiant', $student->id_etudiant)->with(['evaluation', 'cours'])->latest()->get();
                
                // Calculate statistics
                $averageGrade = $notes->avg('note') ?? 0;
                
                $stats = [
                    'student_name' => $student->full_name,
                    'matricule' => $student->matricule,
                    'classe_name' => $student->classe ? $student->classe->nom_classe : 'N/A',
                    'total_notes' => $notes->count(),
                    'average_grade' => round($averageGrade, 2)
                ];
            }
        }
        
        return view('public.rechercher-notes', compact('student', 'notes', 'stats'));
    }
}
