<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\Classe;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignant=Enseignant::all();
        return view('enseignant.index')->with('enseignant',$enseignant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all(); // Retrieve all classes from the Classe model
        return view('enseignant.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Enseignant::create($input);
        return redirect('enseignant')->with('flash_message', "l'enseignant a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $enseignant)
    {
        $enseignant = Enseignant::find($enseignant);
        return view('/enseignant.spectacle')->with('enseignants', $enseignant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $enseignant)
    {
        $enseignant = Enseignant::find($enseignant);
        $classes = Classe::all();
        if (!$enseignant) {
            return redirect()->back()->with('flash_message', 'enseignant introuvable');
        }
        
        return view('enseignant.edit',compact('enseignant','classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $enseignant)
    {
        $enseignant = Enseignant::find($enseignant);
        $input = $request->all();
        $enseignant->update($input);
        return redirect('enseignant')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $enseignant)
    {
        Enseignant::find($enseignant)->delete();
        return back()->with('flash_message', "l'enseignant est supprimée");
    }
}
