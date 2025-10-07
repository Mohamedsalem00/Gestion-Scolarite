<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Note;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnseignantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:enseignant']);
    }

    /**
     * Show the teacher dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id_enseignant)
                             ->where('enseignant_matiere_classe.active', true)
                             ->pluck('id_classe')
                             ->unique();
        
        $classes = collect();
        $students = collect();
        $courses = collect();
        
        if ($teacherClassIds->isNotEmpty()) {
            $classes = Classe::whereIn('id_classe', $teacherClassIds)->get();
            $students = Etudiant::whereIn('id_classe', $teacherClassIds)->get();
            
            // Get teacher's subject assignments (courses)
            $courses = DB::table('enseignant_matiere_classe')
                         ->where('id_enseignant', $teacher->id_enseignant)
                         ->where('enseignant_matiere_classe.active', true)
                         ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
                         ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
                         ->select(
                             'matieres.nom_matiere as matiere',
                             'matieres.code_matiere',
                             'classes.nom_classe',
                             'classes.id_classe',
                             'enseignant_matiere_classe.id_matiere',
                             'enseignant_matiere_classe.id_classe as class_id'
                         )
                         ->get();
        }
        
        // For backward compatibility, also check if teacher has a direct class assignment
        if (isset($teacher->id_classe) && $teacher->id_classe) {
            $directClass = Classe::find($teacher->id_classe);
            if ($directClass && !$classes->contains('id_classe', $directClass->id_classe)) {
                $classes->push($directClass);
                $directStudents = Etudiant::where('id_classe', $teacher->id_classe)->get();
                $students = $students->merge($directStudents);
            }
        }
        
        // Get recent evaluations for teacher's classes
        $recentEvaluations = collect();
        if ($teacherClassIds->isNotEmpty()) {
            $teacherMatiereIds = DB::table('enseignant_matiere_classe')
                                   ->where('id_enseignant', $teacher->id_enseignant)
                                   ->where('enseignant_matiere_classe.active', true)
                                   ->pluck('id_matiere');
            
            $recentEvaluations = Evaluation::whereIn('id_classe', $teacherClassIds)
                                          ->when($teacherMatiereIds->isNotEmpty(), function($query) use ($teacherMatiereIds) {
                                              return $query->whereIn('id_matiere', $teacherMatiereIds);
                                          })
                                          ->with(['matiere', 'classe'])
                                          ->orderBy('date', 'desc')
                                          ->limit(5)
                                          ->get();
        }
        
        // Statistics
        $stats = [
            'students_count' => $students->count(),
            'courses_count' => $courses->count(),
            'evaluations_count' => $recentEvaluations->count(),
            'classes_count' => $classes->count(),
            'classe_names' => $classes->pluck('nom_classe')->implode(', ') ?: 'Aucune classe assignée',
            'classe_name' => $classes->pluck('nom_classe')->implode(', ') ?: 'Aucune classe assignée', // For backward compatibility
            'matieres' => $courses->pluck('matiere')->unique()->implode(', ') ?: $teacher->matiere
        ];

        return view('dashboards.enseignant', compact(
            'teacher', 
            'classes', 
            'students', 
            'courses', 
            'recentEvaluations', 
            'stats'
        ));
    }

    /**
     * Show teacher's students
     */
    public function mesEtudiants()
    {
        $user = Auth::user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id_enseignant)
                             ->where('enseignant_matiere_classe.active', true)
                             ->pluck('id_classe')
                             ->unique();
        
        // Get all students from these classes
        $students = collect();
        $classes = collect();
        
        if ($teacherClassIds->isNotEmpty()) {
            $classes = Classe::whereIn('id_classe', $teacherClassIds)->get();
            $students = Etudiant::whereIn('id_classe', $teacherClassIds)->get();
        }
        
        // For backward compatibility, also check if teacher has a direct class assignment
        if (isset($teacher->id_classe) && $teacher->id_classe) {
            $directClass = Classe::find($teacher->id_classe);
            if ($directClass && !$classes->contains('id_classe', $directClass->id_classe)) {
                $classes->push($directClass);
                $directStudents = Etudiant::where('id_classe', $teacher->id_classe)->get();
                $students = $students->merge($directStudents);
            }
        }

        return view('enseignants.mes-etudiants', compact('students', 'classes', 'teacher'));
    }    /**
     * Show teacher's courses
     */
    public function mesCours()
    {
        $user = Auth::user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }
        
        // Get teacher's subjects and classes from the new matiere system
        $teacherAssignments = DB::table('enseignant_matiere_classe')
                               ->where('id_enseignant', $teacher->id_enseignant)
                               ->where('enseignant_matiere_classe.active', true)
                               ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
                               ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
                               ->select(
                                   'matieres.nom_matiere',
                                   'matieres.code_matiere',
                                   'matieres.id_matiere',
                                   'classes.nom_classe',
                                   'classes.id_classe'
                               )
                               ->get();

        // Create course objects with the new structure (simulating old cours table structure)
        $courses = collect();
        foreach ($teacherAssignments as $assignment) {
            // Create a course object that mimics the old structure for compatibility
            $course = (object) [
                'matiere' => $assignment->nom_matiere,
                'code_matiere' => $assignment->code_matiere,
                'id_matiere' => $assignment->id_matiere,
                'classe' => (object) [
                    'nom_classe' => $assignment->nom_classe,
                    'id_classe' => $assignment->id_classe
                ],
                // Add default time slots (can be customized later)
                'jour' => 'Lundi', // Default day
                'date_debut' => '08:00:00',
                'date_fin' => '09:00:00'
            ];
            $courses->push($course);
        }

        // Organize courses by day and time for proper timetable display
        $organizedCourses = [];
        $timeSlots = [
            ['time' => '08:00-09:00', 'period' => 'morning'],
            ['time' => '09:00-10:00', 'period' => 'morning'],
            ['time' => '10:00-10:30', 'period' => 'pause'],
            ['time' => '10:30-11:30', 'period' => 'morning'],
            ['time' => '11:30-12:30', 'period' => 'morning'],
            ['time' => '12:30-14:00', 'period' => 'pause'],
            ['time' => '14:00-15:00', 'period' => 'afternoon'],
            ['time' => '15:00-16:00', 'period' => 'afternoon'],
            ['time' => '16:00-16:30', 'period' => 'pause'],
            ['time' => '16:30-17:30', 'period' => 'afternoon'],
        ];
        
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        
        // Initialize the organized courses array
        foreach ($days as $day) {
            foreach ($timeSlots as $slot) {
                $organizedCourses[$day][$slot['time']] = null;
            }
        }
        
        // Place courses in their correct time slots
        foreach ($courses as $course) {
            $day = ucfirst(strtolower($course->jour));
            $startTime = date('H:i', strtotime($course->date_debut));
            $endTime = date('H:i', strtotime($course->date_fin));
            $timeSlot = $startTime . '-' . $endTime;
            
            // Find matching time slot (or closest one)
            foreach ($timeSlots as $slot) {
                if ($slot['time'] === $timeSlot || 
                    (strpos($slot['time'], $startTime) !== false)) {
                    $organizedCourses[$day][$slot['time']] = $course;
                    break;
                }
            }
        }

        return view('enseignants.mes-cours', compact('courses', 'teacher', 'organizedCourses', 'timeSlots', 'days'));
    }

    /**
     * Show form to enter grades
     */
    public function saisirNotes(Request $request)
    {
        $user = Auth::user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id_enseignant)
                             ->where('enseignant_matiere_classe.active', true)
                             ->pluck('id_classe')
                             ->unique();
        
        $teacherClasses = collect();
        if ($teacherClassIds->isNotEmpty()) {
            $teacherClasses = Classe::whereIn('id_classe', $teacherClassIds)
                                   ->with(['etudiants'])
                                   ->get();
        }
        
        // For backward compatibility, also check if teacher has a direct class assignment
        if (isset($teacher->id_classe) && $teacher->id_classe) {
            $ownClass = Classe::with(['etudiants'])->find($teacher->id_classe);
            if ($ownClass && !$teacherClasses->contains('id_classe', $ownClass->id_classe)) {
                $teacherClasses->push($ownClass);
            }
        }
        
        // Get selected class from request or default to first class
        $selectedClassId = $request->get('classe_id');
        $selectedClass = null;
        $students = collect();
        $evaluations = collect();
        
        if ($selectedClassId && $teacherClasses->count() > 0) {
            $selectedClass = $teacherClasses->firstWhere('id_classe', $selectedClassId);
        } else if ($teacherClasses->count() > 0) {
            $selectedClass = $teacherClasses->first();
        }
        
        if ($selectedClass) {
            $students = $selectedClass->etudiants ?? collect();
            
            // Get subjects (matieres) this teacher teaches in this class
            $teacherMatiereIds = DB::table('enseignant_matiere_classe')
                                   ->where('id_enseignant', $teacher->id_enseignant)
                                   ->where('id_classe', $selectedClass->id_classe)
                                   ->where('enseignant_matiere_classe.active', true)
                                   ->pluck('id_matiere');

            // Get evaluations for this class and teacher's subjects
            // Only include evaluations that have already ended (past date)
            $evaluations = Evaluation::where('id_classe', $selectedClass->id_classe)
                                   ->when($teacherMatiereIds->isNotEmpty(), function($query) use ($teacherMatiereIds) {
                                       return $query->whereIn('id_matiere', $teacherMatiereIds);
                                   })
                                   ->where(function($query) {
                                       // Include evaluations where the evaluation has ended
                                       // Priority: date_fin > date > created_at (fallback)
                                       $query->where(function($subQuery) {
                                           // If date_fin exists and is in the past
                                           $subQuery->whereNotNull('date_fin')
                                                    ->where('date_fin', '<', now()->startOfDay());
                                       })
                                       ->orWhere(function($subQuery) {
                                           // Or if no date_fin but date exists and is in the past
                                           $subQuery->whereNull('date_fin')
                                                    ->whereNotNull('date')
                                                    ->where('date', '<', now()->startOfDay());
                                       })
                                       ->orWhere(function($subQuery) {
                                           // Or if neither date_fin nor date, but evaluation is old (fallback)
                                           $subQuery->whereNull('date_fin')
                                                    ->whereNull('date')
                                                    ->where('created_at', '<', now()->subDays(1));
                                       });
                                   })
                                   ->with(['matiere', 'classe']) // Load the matiere relationship
                                   ->orderBy('date', 'desc')
                                   ->get();

            // Load existing notes for this class and teacher's subjects
            $existingNotes = Note::whereHas('evaluation', function($query) use ($selectedClass, $teacherMatiereIds) {
                                    $query->where('id_classe', $selectedClass->id_classe);
                                    if ($teacherMatiereIds->isNotEmpty()) {
                                        $query->whereIn('id_matiere', $teacherMatiereIds);
                                    }
                                })
                                ->with(['etudiant', 'evaluation.matiere'])
                                ->get()
                                ->groupBy('id_etudiant');
        } else {
            $evaluations = collect();
            $existingNotes = collect();
        }

        return view('enseignants.saisir-notes', compact('students', 'evaluations', 'teacher', 'teacherClasses', 'selectedClass', 'existingNotes'));
    }

    /**
     * Show teacher profile
     */
    public function profil()
    {
        $user = auth()->user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        // Get teacher's classes and subjects information
        $teacherAssignments = \Illuminate\Support\Facades\DB::table('enseignant_matiere_classe')
                               ->where('id_enseignant', $teacher->id_enseignant)
                               ->where('enseignant_matiere_classe.active', true)
                               ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
                               ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
                               ->select(
                                   'matieres.nom_matiere',
                                   'matieres.code_matiere',
                                   'classes.nom_classe',
                                   'classes.id_classe',
                                   'enseignant_matiere_classe.created_at as date_assignation'
                               )
                               ->get();

        // Get statistics
        $teacherClassIds = \Illuminate\Support\Facades\DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id_enseignant)
                             ->where('enseignant_matiere_classe.active', true)
                             ->pluck('id_classe')
                             ->unique();

        $stats = [
            'total_students' => \App\Models\Etudiant::whereIn('id_classe', $teacherClassIds)->count(),
            'total_classes' => $teacherClassIds->count(),
            'total_matieres' => $teacherAssignments->pluck('code_matiere')->unique()->count(),
            'total_evaluations' => \App\Models\Evaluation::whereIn('id_classe', $teacherClassIds)->count(),
            'recent_notes' => \App\Models\Note::whereHas('etudiant', function($q) use ($teacherClassIds) {
                $q->whereIn('id_classe', $teacherClassIds);
            })->where('created_at', '>', now()->subDays(7))->count()
        ];

        return view('enseignants.profil', compact('teacher', 'user', 'teacherAssignments', 'stats'));
    }

    /**
     * Update teacher profile
     */
    public function updateProfil(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        
        // Get the teacher's enseignant record
        $teacher = \App\Models\Enseignant::where('email', $user->email)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Profil enseignant non trouvé');
        }

        // Validate the request
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:enseignants,email,' . $teacher->id_enseignant . ',id_enseignant',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prénom est obligatoire',
            'telephone.required' => 'Le téléphone est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Format d\'email invalide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
        ]);

        // Update teacher record
        $teacher->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        // Update user record if email changed
        if ($user->email !== $request->email) {
            $user->update([
                'email' => $request->email,
                'name' => $request->prenom . ' ' . $request->nom,
            ]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->route('enseignant.profil')->with('success', 'Profil mis à jour avec succès');
    }
}
