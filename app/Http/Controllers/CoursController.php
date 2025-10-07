<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;
use App\Models\Enseignant;
use App\Models\Matiere;

class CoursController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::all();
        return view('academic.cours.index')->with('cours', $cours);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        $enseignants = Enseignant::all();
        $matieres = Matiere::all();
        
        return view('academic.cours.create', compact('classes', 'enseignants', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Cours::create($input);
        
        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('cours.spectacle')->with('success', 'Le cours a été ajouté avec succès!');
        }
        
        return redirect()->route('cours.index')->with('flash_message', 'Le cours a été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cour)
    {
        $cours = $cour; // Keep variable name consistent in view
        $cours->load(['classe', 'matiere', 'enseignant']);
        return view('academic.cours.show', compact('cours'));
    }

    /**
     * Display the timetable/schedule view.
     */
    public function spectacle()
    {
        // Get all classes
        $classes = Classe::all();
        
        // Get all courses with relationships
        $allCours = Cours::with(['classe', 'matiere', 'enseignant'])->get();
        
        // Get unique time slots dynamically from existing courses
        $timeSlots = Cours::select('date_debut', 'date_fin')
            ->distinct()
            ->orderBy('date_debut')
            ->get()
            ->map(function ($slot) {
                return [
                    'debut' => date('H:i', strtotime($slot->date_debut)),
                    'fin' => date('H:i', strtotime($slot->date_fin))
                ];
            })
            ->unique()
            ->values();
        
        // Days of the week
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
        
        // Organize courses by class and time
        $schedule = [];
        foreach ($classes as $classe) {
            $schedule[$classe->id_classe] = [];
            foreach ($timeSlots as $slot) {
                $schedule[$classe->id_classe][$slot['debut'] . '-' . $slot['fin']] = [];
                foreach ($jours as $jour) {
                    $course = $allCours->where('id_classe', $classe->id_classe)
                        ->where('jour', $jour)
                        ->filter(function ($c) use ($slot) {
                            $debut = date('H:i', strtotime($c->date_debut));
                            $fin = date('H:i', strtotime($c->date_fin));
                            return $debut == $slot['debut'] && $fin == $slot['fin'];
                        })
                        ->first();
                    
                    $schedule[$classe->id_classe][$slot['debut'] . '-' . $slot['fin']][$jour] = $course;
                }
            }
        }
        
        return view('academic.cours.spectacle', compact('classes', 'schedule', 'timeSlots', 'jours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Cours = Cours::find($id);
        $classes = Classe::all();
        $enseignants = Enseignant::all();
        $matieres = Matiere::all();
        
        if (!$Cours) {
            return redirect()->back()->with('flash_message', 'Cours introuvable');
        }

        return view('academic.cours.edit', compact('Cours', 'classes', 'enseignants', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cours = Cours::find($id);
        $input = $request->all();
        $cours->update($input);
        
        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('cours.spectacle')->with('success', 'Le cours a été modifié avec succès!');
        }
        
        return redirect()->route('cours.index')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Cours::find($id)->delete();
        
        // Redirect to timetable if coming from there, otherwise to index
        if ($request->input('from_timetable')) {
            return redirect()->route('cours.spectacle')->with('success', 'Le cours a été supprimé avec succès!');
        }
        
        return redirect()->route('cours.index')->with('flash_message', 'Le cours est supprimé');
    }
}
