<?php

namespace App\Http\Controllers;

use App\Models\EtudePaiement;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudePaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudepaiement = EtudePaiement::all();
        $etudiant = Etudiant::all();
        return view('etudepaiement.index', compact('etudiant', 'etudepaiement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, $frais)
    {
        $etudiant = Etudiant::find($id); // Retrieve the student using the provided ID
        return view('etudepaiement.create', compact('etudiant', 'frais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $e = $input['id_etudiant'];
        $etudiant = Etudiant::find($e);
        EtudePaiement::create($input);
        return redirect('paiement/etudepaiement')->with('flash_message', "Les frais de {$etudiant->nom} ont été payés");
    }

    /**
     * Display the specified resource.
     */
    public function show(EtudePaiement $etudePaiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, $frais)
    {
        $etudepaiement = EtudePaiement::find($id);
        $idetudiant=$etudepaiement->id_etudiant;
        $etudiant = Etudiant::find($idetudiant);
        if (!$etudepaiement) {
            return redirect()->back()->with('flash_message', 'introuvable');
        }
        return view('etudepaiement.edit', compact('etudepaiement', 'etudiant', 'frais'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $etudepaiement)
    {

        $etudepaiement = EtudePaiement::find($etudepaiement);
        $etudiant = Etudiant::find($etudepaiement->id_etudiant);
        $input = $request->all();
        $etudepaiement->update($input);
        
        return redirect('/paiement/etudepaiement')->with('flash_message', "Les frais de {$etudiant->nom} ont été payés");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtudePaiement $etudePaiement)
    {
        //
    }
}
