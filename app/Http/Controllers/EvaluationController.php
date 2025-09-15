<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Classe;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::with('classe')
                                ->latest()
                                ->paginate(15);
        return view('academic.evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('academic.evaluations.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        try {
            $evaluation = Evaluation::create($request->validated());
            
            $redirectRoute = $this->getRedirectRoute($evaluation->type);
            
            return redirect()->route($redirectRoute)
                ->with('success', "L'évaluation de {$evaluation->matiere} a été créée avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de l\'évaluation.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['classe', 'notes.etudiant']);
        return view('academic.evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        $classes = Classe::orderBy('nom_classe')->get();
        return view('academic.evaluations.edit', compact('evaluation', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        try {
            $evaluation->update($request->validated());
            return redirect()->route('academic.evaluations.index')
                ->with('success', "L'évaluation a été mise à jour avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        try {
            $matiere = $evaluation->matiere;
            $evaluation->delete();
            return redirect()->route('academic.evaluations.index')
                ->with('success', "L'évaluation de {$matiere} a été supprimée.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette évaluation.');
        }
    }

    /**
     * Show evaluations by type - keeping legacy routes
     */
    public function showByType($type, $number = 1)
    {
        $evaluations = Evaluation::where('type', $type)
                                ->with(['classe', 'notes'])
                                ->get()
                                ->groupBy('id_classe');
        
        return view('evaluation.by-type', compact('evaluations', 'type', 'number'));
    }

    // Legacy methods for existing routes
    public function show1() { return $this->showByType('devoir', 1); }
    public function show2() { return $this->showByType('devoir', 2); }
    public function show3() { return $this->showByType('devoir', 3); }
    public function show4() { return $this->showByType('examen', 1); }
    public function show5() { return $this->showByType('examen', 2); }
    public function show6() { return $this->showByType('examen', 3); }

    /**
     * Get redirect route based on evaluation type
     */
    private function getRedirectRoute($type)
    {
        $routes = [
            'devoir' => 'evaluations.index',
            'examen' => 'evaluations.index',
            'controle' => 'evaluations.index',
        ];

        return $routes[$type] ?? 'evaluations.index';
    }
}
