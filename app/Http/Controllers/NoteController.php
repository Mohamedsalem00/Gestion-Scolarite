<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Matiere;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of notes with filters
     */
    public function index(Request $request)
    {
        $query = Note::with(['etudiant', 'classe', 'evaluation.matiere', 'matiere']);
        
        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('etudiant', function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('classe')) {
            $query->where('id_classe', $request->classe);
        }
        
        if ($request->filled('evaluation')) {
            $query->where('id_evaluation', $request->evaluation);
        }
        
        $notes = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get filter options
        $classes = Classe::orderBy('nom_classe')->get();
        $evaluations = Evaluation::with('matiere')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($eval) {
                $eval->matiere_name = $eval->matiere->nom_matiere ?? 'N/A';
                return $eval;
            });
        
        return view('academic.notes.index', compact('notes', 'classes', 'evaluations'));
    }
    
    /**
     * Check if the current user can manage notes
     */
    private function canManageNote($studentId = null, $evaluationId = null, $noteId = null)
    {
        $user = auth()->user();
        
        // Admins can manage all notes
        if ($user->hasRole('admin') || $user->hasRole('administrateur')) {
            return true;
        }
        
        // Teachers can only manage notes for their students and subjects
        if ($user->hasRole('enseignant')) {
            $enseignant = $user->enseignant;
            
            if (!$enseignant) {
                return false;
            }
            
            // If checking specific note
            if ($noteId) {
                $note = Note::find($noteId);
                if (!$note) return false;
                
                // Check if teacher teaches this subject to this student's class
                return $enseignant->matieres()
                    ->where('id_matiere', $note->id_matiere)
                    ->whereHas('classes', function($q) use ($note) {
                        $q->where('classes.id_classe', $note->id_classe);
                    })
                    ->exists();
            }
            
            // If checking evaluation
            if ($evaluationId) {
                $evaluation = Evaluation::find($evaluationId);
                if (!$evaluation) return false;
                
                return $enseignant->matieres()
                    ->where('id_matiere', $evaluation->id_matiere)
                    ->whereHas('classes', function($q) use ($evaluation) {
                        $q->where('classes.id_classe', $evaluation->id_classe);
                    })
                    ->exists();
            }
        }
        
        return false;
    }
    
    /**
     * Store a newly created note
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_evaluation' => 'required|exists:evaluations,id_evaluation',
            'note' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string'
        ]);
        
        // Check authorization
        if (!$this->canManageNote($request->id_etudiant, $request->id_evaluation)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à ajouter cette note.');
        }
        
        // Check if note already exists
        $existingNote = Note::where('id_etudiant', $request->id_etudiant)
            ->where('id_evaluation', $request->id_evaluation)
            ->first();
        
        if ($existingNote) {
            return redirect()->back()
                ->with('error', 'Une note existe déjà pour cet étudiant et cette évaluation.');
        }
        
        // Get evaluation to extract related data
        $evaluation = Evaluation::findOrFail($request->id_evaluation);
        
        // Create note
        Note::create([
            'id_etudiant' => $request->id_etudiant,
            'id_evaluation' => $request->id_evaluation,
            'id_classe' => $evaluation->id_classe,
            'id_matiere' => $evaluation->id_matiere,
            'note' => $request->note,
            'type' => $evaluation->type,
            'commentaire' => $request->commentaire
        ]);
        
        // Redirect based on user role
        if (auth()->user()->hasRole('enseignant')) {
            return redirect()->route('evaluations.show', $evaluation)
                ->with('success', 'La note a été ajoutée avec succès.');
        }
        
        return redirect()->route('notes.index')
            ->with('success', 'La note a été ajoutée avec succès.');
    }
    
    /**
     * Show the form for editing a note
     */
    public function edit(Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette note.');
        }
        
        $note->load(['etudiant', 'evaluation', 'classe']);
        
        return view('academic.notes.edit', compact('note'));
    }
    
    /**
     * Update the specified note
     */
    public function update(Request $request, Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette note.');
        }
        
        $request->validate([
            'note' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string'
        ]);
        
        $note->update([
            'note' => $request->note,
            'commentaire' => $request->commentaire
        ]);
        
        // Redirect based on user role
        if (auth()->user()->hasRole('enseignant')) {
            return redirect()->route('evaluations.show', $note->evaluation)
                ->with('success', 'La note a été modifiée avec succès.');
        }
        
        return redirect()->route('notes.index')
            ->with('success', 'La note a été modifiée avec succès.');
    }
    
    /**
     * Remove the specified note
     */
    public function destroy(Note $note)
    {
        if (!$this->canManageNote(null, null, $note->id_note)) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette note.');
        }
        
        $note->delete();
        
        return redirect()->back()
            ->with('success', 'La note a été supprimée avec succès.');
    }

    /**
     * Display student grade transcript
     */
    public function transcript(Etudiant $etudiant, $trimestre = null)
    {
        // Get all notes for the student
        $notesQuery = Note::with(['evaluation.matiere', 'matiere', 'classe'])
            ->where('id_etudiant', $etudiant->id_etudiant);

        // Filter by trimestre if provided
        if ($trimestre) {
            $notesQuery->whereHas('evaluation', function($q) use ($trimestre) {
                $start = $this->getTrimestreStartDate($trimestre);
                $end = $this->getTrimestreEndDate($trimestre);
                $q->whereBetween('date', [$start, $end]);
            });
        }

        $notes = $notesQuery->orderBy('created_at', 'desc')->get();

        // Group notes by matiere for better organization
        $notesByMatiere = $notes->groupBy(function($note) {
            return $note->matiere ? $note->matiere->nom_matiere : ($note->evaluation->matiere ? $note->evaluation->matiere->nom_matiere : 'N/A');
        });

        // Calculate average for each matiere
        $averages = [];
        foreach ($notesByMatiere as $matiere => $matiereNotes) {
            $totalPoints = $matiereNotes->sum('note');
            $totalMaxPoints = $matiereNotes->sum(function($note) {
                return $note->evaluation ? $note->evaluation->note_max : 20;
            });
            $averages[$matiere] = $totalMaxPoints > 0 ? ($totalPoints / $totalMaxPoints) * 20 : 0;
        }

        // Calculate overall average
        $overallAverage = count($averages) > 0 ? array_sum($averages) / count($averages) : 0;

        return view('academic.notes.transcript', compact(
            'etudiant', 
            'notes', 
            'notesByMatiere', 
            'averages', 
            'overallAverage', 
            'trimestre'
        ));
    }

    /**
     * Show all students for transcript selection
     */
    public function transcriptIndex(Request $request)
    {
        $query = Etudiant::with('classe');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('numero_etudiant', 'like', "%{$search}%");
            });
        }

        if ($request->filled('classe')) {
            $query->where('id_classe', $request->classe);
        }

        $etudiants = $query->orderBy('nom')->orderBy('prenom')->paginate(20);
        $classes = Classe::orderBy('nom_classe')->get();

        return view('academic.notes.transcript-index', compact('etudiants', 'classes'));
    }

    /**
     * Helper methods for trimestre dates
     */
    private function getTrimestreStartDate($trimestre)
    {
        $year = date('Y');
        switch ($trimestre) {
            case '1': return "{$year}-09-01";
            case '2': return "{$year}-01-01";
            case '3': return "{$year}-04-01";
            default: return "{$year}-09-01";
        }
    }

    private function getTrimestreEndDate($trimestre)
    {
        $year = date('Y');
        switch ($trimestre) {
            case '1': return "{$year}-12-31";
            case '2': return ($year + 1) . "-03-31";
            case '3': return ($year + 1) . "-06-30";
            default: return ($year + 1) . "-06-30";
        }
    }
}
