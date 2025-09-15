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
        $teacher = Auth::user();
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id)
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
                         ->where('id_enseignant', $teacher->id)
                         ->where('enseignant_matiere_classe.active', true)
                         ->join('matieres', 'enseignant_matiere_classe.id_matiere', '=', 'matieres.id_matiere')
                         ->join('classes', 'enseignant_matiere_classe.id_classe', '=', 'classes.id_classe')
                         ->select(
                             'matieres.nom_matiere as matiere',
                             'matieres.code_matiere',
                             'classes.nom_classe',
                             'classes.id_classe'
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
                                   ->where('id_enseignant', $teacher->id)
                                   ->where('enseignant_matiere_classe.active', true)
                                   ->pluck('id_matiere');
            
            $recentEvaluations = Evaluation::whereIn('id_classe', $teacherClassIds)
                                          ->when($teacherMatiereIds->isNotEmpty(), function($query) use ($teacherMatiereIds) {
                                              return $query->whereIn('id_matiere', $teacherMatiereIds);
                                          })
                                          ->with('matiere_relation')
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
            'classe_names' => $classes->pluck('nom_classe')->implode(', ') ?: 'Aucune classe assignée'
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
        $teacher = Auth::user();
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id)
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
        $teacher = Auth::user();
        
        // Get teacher's subjects and classes from the new matiere system
        $teacherAssignments = DB::table('enseignant_matiere_classe')
                               ->where('id_enseignant', $teacher->id)
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
        $teacher = Auth::user();
        
        // Get all classes this teacher teaches through the new matiere system
        $teacherClassIds = DB::table('enseignant_matiere_classe')
                             ->where('id_enseignant', $teacher->id)
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
                                   ->where('id_enseignant', $teacher->id)
                                   ->where('id_classe', $selectedClass->id_classe)
                                   ->where('enseignant_matiere_classe.active', true)
                                   ->pluck('id_matiere');

            // Get evaluations for this class and teacher's subjects
            $evaluations = Evaluation::where('id_classe', $selectedClass->id_classe)
                                   ->when($teacherMatiereIds->isNotEmpty(), function($query) use ($teacherMatiereIds) {
                                       return $query->whereIn('id_matiere', $teacherMatiereIds);
                                   })
                                   ->with('matiere_relation') // Load the matiere relationship
                                   ->orderBy('date', 'desc')
                                   ->get();

            // Load existing notes for this class and teacher's subjects
            $existingNotes = Note::whereHas('evaluation', function($query) use ($selectedClass, $teacherMatiereIds) {
                                    $query->where('id_classe', $selectedClass->id_classe);
                                    if ($teacherMatiereIds->isNotEmpty()) {
                                        $query->whereIn('id_matiere', $teacherMatiereIds);
                                    }
                                })
                                ->with(['etudiant', 'evaluation.matiere_relation'])
                                ->get()
                                ->groupBy('id_etudiant');
        } else {
            $evaluations = collect();
            $existingNotes = collect();
        }

        return view('enseignants.saisir-notes', compact('students', 'evaluations', 'teacher', 'teacherClasses', 'selectedClass', 'existingNotes'));
    }
}
