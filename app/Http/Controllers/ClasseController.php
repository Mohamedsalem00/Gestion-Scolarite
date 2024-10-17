<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Enseignant;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classe = Classe::all();
        return view('classe.index')->with('classe', $classe);
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
    public function store(Request $request)
    {
        $input = $request->all();
        Classe::create($input);
        return redirect('classe')->with('flash_message', "le classe a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $Classe)
    {
        $Classe = Classe::find($Classe);
        return view('/classe.spectacle')->with('classes', $Classe);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $Classe)
    {
        $Classe = Classe::find($Classe);
        if (!$Classe) {
            return redirect()->back()->with('flash_message', 'classe introuvable');
        }

        return view('classe.edit', compact('Classe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Classe)
    {
        $Classe = Classe::find($Classe);
        $input = $request->all();
        $Classe->update($input);
        return redirect('classe')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Classe)
    {
        Classe::find($Classe)->delete();
        return back()->with('flash_message', "le classe est supprimée");
    }
}
