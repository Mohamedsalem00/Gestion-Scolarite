<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Note;

class PublicController extends Controller
{
    /**
     * Show the public grade search form and handle search
     */
    public function rechercherNotes(Request $request)
    {
        $notes = collect();
        $etudiant = null;
        
        if ($request->isMethod('post')) {
            $request->validate([
                'matricule' => 'required|string'
            ]);
            
            // Find student by matricule
            $etudiant = Etudiant::where('matricule', $request->matricule)->first();
            
            if ($etudiant) {
                // Get student's grades
                $notes = Note::where('id_etudiant', $etudiant->id_etudiant)
                            ->with(['evaluation.cours'])
                            ->orderBy('created_at', 'desc')
                            ->get();
            } else {
                return back()->withErrors(['matricule' => 'Aucun étudiant trouvé avec ce matricule.']);
            }
        }
        
        return view('public.rechercher-notes', compact('notes', 'etudiant'));
    }
}
