<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::withCount(['etudiants', 'enseignants', 'cours'])
                          ->orderBy('nom_classe')
                          ->get();
        return view('classe.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Handle translations if provided
            if ($request->has('nom_classe_translations')) {
                $data['nom_classe_translations'] = array_filter($request->nom_classe_translations ?: []);
            }
            if ($request->has('niveau_translations')) {
                $data['niveau_translations'] = array_filter($request->niveau_translations ?: []);
            }
            
            $classe = Classe::create($data);
            return redirect()->route('classe.index')
                ->with('success', "La classe {$classe->nom_classe} a été créée avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de la classe.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $classe->load(['etudiants', 'enseignants', 'cours.enseignant', 'evaluations']);
        return view('classe.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        return view('classe.edit', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        try {
            $data = $request->validated();
            
            // Handle translations if provided
            if ($request->has('nom_classe_translations')) {
                $data['nom_classe_translations'] = array_filter($request->nom_classe_translations ?: []);
            }
            if ($request->has('niveau_translations')) {
                $data['niveau_translations'] = array_filter($request->niveau_translations ?: []);
            }
            
            $classe->update($data);
            return redirect()->route('classe.index')
                ->with('success', "La classe {$classe->nom_classe} a été mise à jour.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        try {
            $nom = $classe->nom_classe;
            
            // Check if class has students or teachers before deletion
            if ($classe->etudiants()->exists() || $classe->enseignants()->exists()) {
                return redirect()->back()
                    ->with('error', 'Impossible de supprimer cette classe car elle contient des étudiants ou des enseignants.');
            }
            
            $classe->delete();
            return redirect()->route('classe.index')
                ->with('success', "La classe {$nom} a été supprimée.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette classe.');
        }
    }
}
