<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\Classe;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiant = Etudiant::all();
        return view('etudiants.index')->with('etudiant', $etudiant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all(); // Retrieve all classes from the Classe model
        return view('etudiants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Etudiant::create($input);
        return redirect('etudiant')->with('flash_message', "l'étudiant a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $etudiant)
    {
        $etudiant = Etudiant::find($etudiant);
        return view('/etudiants.spectacle')->with('etudiants', $etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $etudiant)
    {
        $etudiant = Etudiant::find($etudiant);
        $classes = Classe::all();
        if (!$etudiant) {
            return redirect()->back()->with('flash_message', 'etudiant introuvable');
        }

        return view('etudiants.edit', compact('etudiant', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $etudiant)
    {
        $etudiant = Etudiant::find($etudiant);
        $input = $request->all();
        $etudiant->update($input);
        return redirect('etudiant')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $etudiant)
    {
        Etudiant::find($etudiant)->delete();
        return back()->with('flash_message', "l'etudiant est supprimée");
    }
}
