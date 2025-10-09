<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NoteController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware to all methods except public transcript access
        $this->middleware('auth')->except(['publicTranscript', 'publicTranscriptSearch']);
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
    public function transcript(Request $request, Etudiant $etudiant, $trimestre = null)
    {
        // Get selected academic year from request, default to current
        $selectedYear = $request->get('year');
        $academicYear = $selectedYear ?: $this->getCurrentAcademicYear();
        
        // Get available academic years for this student
        $availableYears = $this->getAvailableAcademicYearsForStudent($etudiant);
        
        // Get all notes for the student with improved relationships
        $notesQuery = Note::with(['evaluation.matiere', 'matiere', 'classe'])
            ->where('id_etudiant', $etudiant->id_etudiant);

        // Filter by selected academic year
        $notesQuery->whereHas('evaluation', function($q) use ($academicYear) {
            $yearRange = $this->getAcademicYearDateRange($academicYear);
            $q->whereBetween('date', [$yearRange['start'], $yearRange['end']]);
        });

        // Filter by trimestre if provided with better date handling
        if ($trimestre) {
            $notesQuery->whereHas('evaluation', function($q) use ($trimestre, $academicYear) {
                $dates = $this->getTrimestreDateRangeForYear($trimestre, $academicYear);
                $q->whereBetween('date', [$dates['start'], $dates['end']]);
            });
        }

        $notes = $notesQuery->orderBy('created_at', 'desc')->get();

        // Group notes by matiere for better organization
        $notesByMatiere = $notes->groupBy(function($note) {
            return $note->matiere?->code_matiere ?? 
                   $note->evaluation?->matiere?->code_matiere ?? 
                   'Matière non spécifiée';
        });

        // Calculate statistics with improved logic
        $statistics = $this->calculateTranscriptStatistics($notesByMatiere);
        
        // Get trimestre info with proper labels
        $trimestreInfo = $trimestre ? $this->getTrimestreInfo($trimestre) : null;

        return view('academic.notes.transcript', compact(
            'etudiant', 
            'notes', 
            'notesByMatiere', 
            'statistics',
            'trimestre',
            'trimestreInfo',
            'academicYear',
            'availableYears'
        ));
    }

    /**
     * Public: Search for student transcript by matricule (NO LOGIN REQUIRED)
     */
    public function publicTranscriptSearch(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string'
        ]);
        
        $etudiant = Etudiant::where('matricule', $request->matricule)->first();
        
        if (!$etudiant) {
            return redirect()->route('accueil')
                ->with('error', 'Aucun étudiant trouvé avec ce matricule.');
        }
        
        // Redirect to public transcript view
        return redirect()->route('public.transcript.show', $etudiant->matricule);
    }

    /**
     * Public: Display student transcript (NO LOGIN REQUIRED)
     */
    public function publicTranscript($matricule, $trimestre = null)
    {
        // Find student by matricule
        $etudiant = Etudiant::where('matricule', $matricule)->firstOrFail();
        
        // Get selected academic year from request, default to current
        $selectedYear = request()->get('year');
        $academicYear = $selectedYear ?: $this->getCurrentAcademicYear();
        
        // Get available academic years for this student
        $availableYears = $this->getAvailableAcademicYearsForStudent($etudiant);
        
        // Get all notes for the student with improved relationships
        $notesQuery = Note::with(['evaluation.matiere', 'matiere', 'classe'])
            ->where('id_etudiant', $etudiant->id_etudiant);

        // Filter by selected academic year
        $notesQuery->whereHas('evaluation', function($q) use ($academicYear) {
            $yearRange = $this->getAcademicYearDateRange($academicYear);
            $q->whereBetween('date', [$yearRange['start'], $yearRange['end']]);
        });

        // Filter by trimestre if provided with better date handling
        if ($trimestre) {
            $notesQuery->whereHas('evaluation', function($q) use ($trimestre, $academicYear) {
                $dates = $this->getTrimestreDateRangeForYear($trimestre, $academicYear);
                $q->whereBetween('date', [$dates['start'], $dates['end']]);
            });
        }

        $notes = $notesQuery->orderBy('created_at', 'desc')->get();

        // Group notes by matiere for better organization
        $notesByMatiere = $notes->groupBy(function($note) {
            return $note->matiere?->code_matiere ?? 
                   $note->evaluation?->matiere?->code_matiere ?? 
                   'Matière non spécifiée';
        });

        // Calculate statistics with improved logic
        $statistics = $this->calculateTranscriptStatistics($notesByMatiere);
        
        // Get trimestre info with proper labels
        $trimestreInfo = $trimestre ? $this->getTrimestreInfo($trimestre) : null;

        return view('public.transcript', compact(
            'etudiant', 
            'notes', 
            'notesByMatiere', 
            'statistics',
            'trimestre',
            'trimestreInfo',
            'academicYear',
            'availableYears'
        ));
    }

    /**
     * Admin: Search for student transcript by matricule (REQUIRES LOGIN)
     */
    public function transcriptSearch(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string'
        ]);
        
        $etudiant = Etudiant::where('matricule', $request->matricule)->first();
        
        if (!$etudiant) {
            return redirect()->route('accueil')
                ->with('error', 'Aucun étudiant trouvé avec ce matricule.');
        }
        
        // Redirect to admin transcript view
        return redirect()->route('rapports.notes.transcript', $etudiant->matricule);
    }

    /**
     * Show all students for transcript selection
     */
    public function transcriptIndex(Request $request)
    {
        $classes = Classe::orderBy('nom_classe')->get();
        
        // Only load students if there's a search query or class filter
        if ($request->hasAny(['search', 'classe'])) {
            $query = Etudiant::with('classe');

            // Apply search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('matricule', 'like', "%{$search}%");
                });
            }

            // Apply class filter
            if ($request->filled('classe')) {
                $query->where('id_classe', $request->classe);
            }

            $etudiants = $query->orderBy('nom')->orderBy('prenom')->paginate(12);
        } else {
            // Create empty paginator when no search
            $etudiants = new \Illuminate\Pagination\LengthAwarePaginator(
                [], 0, 12, 1, ['path' => $request->url()]
            );
        }

        return view('academic.notes.transcript-index', compact('etudiants', 'classes'));
    }

    /**
     * Helper methods for transcript management
     */
    private function getTrimestreDateRange($trimestre, $etudiant = null)
    {
        // Get academic year start month from config (default: October = 10)  
        $academicStartMonth = config('school.academic_year_start_month', 10);
        
        // Get trimestre configuration from config
        $trimestreConfig = config('school.trimestres', [
            '1' => ['start_month' => 10, 'start_day' => 1, 'end_month' => 12, 'end_day' => 31],
            '2' => ['start_month' => 1, 'start_day' => 1, 'end_month' => 4, 'end_day' => 30], 
            '3' => ['start_month' => 5, 'start_day' => 1, 'end_month' => 7, 'end_day' => 31]
        ]);
        
        if (!isset($trimestreConfig[$trimestre])) {
            return [
                'start' => '2024-01-01',
                'end' => '2025-12-31'
            ];
        }
        
        $config = $trimestreConfig[$trimestre];
        
        // Detect academic year based on student's evaluation dates if available
        if ($etudiant) {
            $studentEvaluations = \App\Models\Note::with('evaluation')
                ->where('id_etudiant', $etudiant->id_etudiant)
                ->get()
                ->pluck('evaluation.date')
                ->filter()
                ->sort();
                
            if ($studentEvaluations->isNotEmpty()) {
                // Find the most common academic year from student's evaluations
                $academicYears = [];
                foreach ($studentEvaluations as $date) {
                    $year = (int) $date->format('Y');
                    $month = (int) $date->format('n');
                    
                    // Determine which academic year this evaluation belongs to
                    if ($month >= $academicStartMonth) {
                        $academicYears[] = $year;
                    } else {
                        $academicYears[] = $year - 1;
                    }
                }
                
                // Use the most recent academic year with evaluations
                $academicYear = max($academicYears);
            } else {
                // Fallback if no evaluations
                $academicYear = $this->getCurrentAcademicYearNumber();
            }
        } else {
            // Fallback to current academic year calculation
            $academicYear = $this->getCurrentAcademicYearNumber();
        }
        
        // Calculate start and end years for the trimester
        if ($config['start_month'] >= $academicStartMonth) {
            $startYear = $academicYear;
        } else {
            $startYear = $academicYear + 1;
        }
        
        if ($config['end_month'] >= $academicStartMonth) {
            $endYear = $academicYear;
        } else {
            $endYear = $academicYear + 1;
        }
        
        return [
            'start' => sprintf("%04d-%02d-%02d", $startYear, $config['start_month'], $config['start_day']),
            'end' => sprintf("%04d-%02d-%02d", $endYear, $config['end_month'], $config['end_day'])
        ];
    }

    private function calculateTranscriptStatistics($notesByMatiere)
    {
        $averages = [];
        $totalNotes = 0;
        $passedNotes = 0;
        $excellentNotes = 0;
        $totalCoeff = 0;
        $weightedSum = 0;

        foreach ($notesByMatiere as $matiere => $matiereNotes) {
            $matiereStats = [
                'total_points' => 0,
                'total_max_points' => 0,
                'note_count' => $matiereNotes->count(),
                'coefficient' => 1 // Default coefficient, can be enhanced
            ];

            foreach ($matiereNotes as $note) {
                $noteMax = $note->evaluation?->note_max ?? 20;
                $noteSur20 = ($note->note / $noteMax) * 20;
                
                $matiereStats['total_points'] += $note->note;
                $matiereStats['total_max_points'] += $noteMax;
                
                $totalNotes++;
                if ($noteSur20 >= 10) $passedNotes++;
                if ($noteSur20 >= 16) $excellentNotes++;
            }

            // Calculate matiere average
            $matiereAverage = $matiereStats['total_max_points'] > 0 
                ? ($matiereStats['total_points'] / $matiereStats['total_max_points']) * 20 
                : 0;
            
            $averages[$matiere] = [
                'average' => $matiereAverage,
                'coefficient' => $matiereStats['coefficient'],
                'note_count' => $matiereStats['note_count'],
                'grade_letter' => $this->getGradeLetter($matiereAverage)
            ];

            // Weighted average calculation
            $weightedSum += $matiereAverage * $matiereStats['coefficient'];
            $totalCoeff += $matiereStats['coefficient'];
        }

        $overallAverage = $totalCoeff > 0 ? $weightedSum / $totalCoeff : 0;

        return [
            'averages' => $averages,
            'overall_average' => $overallAverage,
            'total_notes' => $totalNotes,
            'passed_notes' => $passedNotes,
            'excellent_notes' => $excellentNotes,
            'success_rate' => $totalNotes > 0 ? ($passedNotes / $totalNotes) * 100 : 0,
            'excellence_rate' => $totalNotes > 0 ? ($excellentNotes / $totalNotes) * 100 : 0,
            'overall_grade' => $this->getGradeLetter($overallAverage),
            'mention' => $this->getMention($overallAverage)
        ];
    }

    private function getGradeLetter($average)
    {
        if ($average >= 18) return 'A+';
        if ($average >= 16) return 'A';
        if ($average >= 14) return 'B+';
        if ($average >= 12) return 'B';
        if ($average >= 10) return 'C';
        if ($average >= 8) return 'D';
        return 'F';
    }

    private function getMention($average)
    {
        if ($average >= 16) return 'Très Bien';
        if ($average >= 14) return 'Bien';
        if ($average >= 12) return 'Assez Bien';
        if ($average >= 10) return 'Passable';
        return 'Insuffisant';
    }

    private function getTrimestreInfo($trimestre)
    {
        $trimestreNames = [
            '1' => '1er Trimestre',
            '2' => '2ème Trimestre', 
            '3' => '3ème Trimestre'
        ];

        $dateRange = $this->getTrimestreDateRange($trimestre);
        
        return [
            'number' => $trimestre,
            'name' => $trimestreNames[$trimestre] ?? 'Trimestre inconnu',
            'start_date' => $dateRange['start'],
            'end_date' => $dateRange['end'],
            'formatted_period' => date('d/m/Y', strtotime($dateRange['start'])) . ' - ' . date('d/m/Y', strtotime($dateRange['end']))
        ];
    }

    private function getCurrentAcademicYear()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        
        // Get academic year start month from config (default: October = 10)
        $academicStartMonth = config('school.academic_year_start_month', 10);
        
        if ($currentMonth >= $academicStartMonth) {
            return $currentYear . '/' . ($currentYear + 1);
        } else {
            return ($currentYear - 1) . '/' . $currentYear;
        }
    }
    
    private function getCurrentAcademicYearNumber()
    {
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');
        
        // Get academic year start month from config (default: October = 10)
        $academicStartMonth = config('school.academic_year_start_month', 10);
        
        if ($currentMonth >= $academicStartMonth) {
            return $currentYear;
        } else {
            return $currentYear - 1;
        }
    }
    
    private function getAcademicYearForStudent($etudiant)
    {
        // Get all evaluation dates for this student
        $evaluationDates = Note::with('evaluation')
            ->where('id_etudiant', $etudiant->id_etudiant)
            ->get()
            ->pluck('evaluation.date')
            ->filter()
            ->map(function($date) {
                return Carbon::parse($date);
            });
            
        if ($evaluationDates->isEmpty()) {
            // If no evaluations, fall back to current academic year
            return $this->getCurrentAcademicYear();
        }
        
        // Find the most common academic year from evaluation dates
        $academicStartMonth = config('school.academic_year_start_month', 10);
        $academicYears = $evaluationDates->map(function($date) use ($academicStartMonth) {
            $year = $date->year;
            $month = $date->month;
            
            if ($month >= $academicStartMonth) {
                return $year . '/' . ($year + 1);
            } else {
                return ($year - 1) . '/' . $year;
            }
        });
        
        // Return the most frequent academic year, or the latest one
        $yearCounts = $academicYears->countBy();
        return $yearCounts->keys()->sortDesc()->first() ?? $this->getCurrentAcademicYear();
    }
    
    private function getAvailableAcademicYearsForStudent($etudiant)
    {
        // Get all evaluation dates for this student
        $evaluationDates = Note::with('evaluation')
            ->where('id_etudiant', $etudiant->id_etudiant)
            ->get()
            ->pluck('evaluation.date')
            ->filter()
            ->map(function($date) {
                return Carbon::parse($date);
            });
            
        $academicStartMonth = config('school.academic_year_start_month', 10);
        $years = collect();
        
        // Always include current academic year
        $years->push($this->getCurrentAcademicYear());
        
        // Add years based on evaluation dates
        foreach ($evaluationDates as $date) {
            $year = $date->year;
            $month = $date->month;
            
            if ($month >= $academicStartMonth) {
                $academicYear = $year . '/' . ($year + 1);
            } else {
                $academicYear = ($year - 1) . '/' . $year;
            }
            
            $years->push($academicYear);
        }
        
        return $years->unique()->sort()->values();
    }
    
    private function getAcademicYearDateRange($academicYear)
    {
        // Parse academic year (e.g., "2024/2025")
        $years = explode('/', $academicYear);
        $startYear = (int) $years[0];
        $endYear = (int) $years[1];
        
        $academicStartMonth = config('school.academic_year_start_month', 10);
        
        return [
            'start' => sprintf("%04d-%02d-01", $startYear, $academicStartMonth),
            'end' => sprintf("%04d-%02d-30", $endYear, $academicStartMonth - 1 ?: 9)
        ];
    }
    
    private function getTrimestreDateRangeForYear($trimestre, $academicYear)
    {
        // Parse academic year
        $years = explode('/', $academicYear);
        $startYear = (int) $years[0];
        
        // Get trimestre configuration from config
        $trimestreConfig = config('school.trimestres', [
            '1' => ['start_month' => 10, 'start_day' => 1, 'end_month' => 12, 'end_day' => 31],
            '2' => ['start_month' => 1, 'start_day' => 1, 'end_month' => 4, 'end_day' => 30], 
            '3' => ['start_month' => 5, 'start_day' => 1, 'end_month' => 9, 'end_day' => 30]
        ]);
        
        if (!isset($trimestreConfig[$trimestre])) {
            return [
                'start' => $startYear . '-01-01',
                'end' => ($startYear + 1) . '-12-31'
            ];
        }
        
        $config = $trimestreConfig[$trimestre];
        $academicStartMonth = config('school.academic_year_start_month', 10);
        
        // Calculate start and end years for the trimester
        if ($config['start_month'] >= $academicStartMonth) {
            $startYearForTrimestre = $startYear;
        } else {
            $startYearForTrimestre = $startYear + 1;
        }
        
        if ($config['end_month'] >= $academicStartMonth) {
            $endYearForTrimestre = $startYear;
        } else {
            $endYearForTrimestre = $startYear + 1;
        }
        
        return [
            'start' => sprintf("%04d-%02d-%02d", $startYearForTrimestre, $config['start_month'], $config['start_day']),
            'end' => sprintf("%04d-%02d-%02d", $endYearForTrimestre, $config['end_month'], $config['end_day'])
        ];
    }
}
