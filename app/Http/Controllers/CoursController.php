<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::all();
        return view('cour.index')->with('cours', $cours);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all(); // Retrieve all classes from the Classe model
        return view('cour.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Cours::create($input);
        return redirect('cour')->with('flash_message', "le cour a été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cours)
    {
        $joursSemaine = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi'
        ];   

        $cours = Cours::find($cours);
        $classe = Classe::all();
        $af1 = DB::table('cours')->where('id_classe', 1)->get();
        $debutinfo1AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('cours')->where('date_debut', '11:15:00')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('cours')->where('date_debut', '08:00:00')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('cours')->where('date_debut', '10:00:00')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('cours')->where('date_debut', '12:00:00')->where('id_classe', 14)->get();
        $debut08 = Cours::where('date_debut', '08:00:00')->first();
        $debut10 = Cours::where('date_debut', '10:00:00')->first();
        $debut12 = Cours::where('date_debut', '12:00:00')->first();
        $fine11 = Cours::where('date_fin', '11:00:00')->first();
        $debut1115 = Cours::where('date_debut', '11:15:00')->first();
        $fine12 = Cours::where('date_fin', '12:00:00')->first();
        $fine14 = Cours::where('date_fin', '14:00:00')->first();
        $fine10 = Cours::where('date_fin', '10:00:00')->first();
        return view('/cour.spectacle')->with('cours', $cours)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['af1' => $af1])->with(['debut08' => $debut08])->
        with(['fine11' => $fine11])->with(['debut1115' => $debut1115])->
        with(['fine12' => $fine12])->with(['fine14' => $fine14])->with(['fine10' => $fine10])->
        with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
        with(['debutinfo1AS' => $debutinfo1AS])->with(['milieuinfo1AS' => $milieuinfo1AS])->with(['fineinfo1AS' => $fineinfo1AS])->
        with(['debutinfo2AS' => $debutinfo2AS])->with(['milieuinfo2AS' => $milieuinfo2AS])->with(['fineinfo2AS' => $fineinfo2AS])->
        with(['debutinfo3AS' => $debutinfo3AS])->with(['milieuinfo3AS' => $milieuinfo3AS])->with(['fineinfo3AS' => $fineinfo3AS])->
        with(['debutinfo4AS' => $debutinfo4AS])->with(['milieuinfo4AS' => $milieuinfo4AS])->with(['fineinfo4AS' => $fineinfo4AS])->
        with(['debutinfo5AS' => $debutinfo5AS])->with(['milieuinfo5AS' => $milieuinfo5AS])->with(['fineinfo5AS' => $fineinfo5AS])->
        with(['debutinfo6AS' => $debutinfo6AS])->with(['milieuinfo6AS' => $milieuinfo6AS])->with(['fineinfo6AS' => $fineinfo6AS])->
        with(['debutinfo7ASD' => $debutinfo7ASD])->with(['milieuinfo7ASD' => $milieuinfo7ASD])->with(['fineinfo7ASD' => $fineinfo7ASD])->
        with(['debutinfo7ASC' => $debutinfo7ASC])->with(['milieuinfo7ASC' => $milieuinfo7ASC])->with(['fineinfo7ASC' => $fineinfo7ASC])
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $Cours)
    {
        $Cours = Cours::find($Cours);
        $classes = Classe::all();
        if (!$Cours) {
            return redirect()->back()->with('flash_message', 'cour introuvable');
        }

        return view('cour.edit', compact('Cours', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Cours)
    {
        $Cours = Cours::find($Cours);
        $input = $request->all();
        $Cours->update($input);
        return redirect('/cour/spectacle')->with('flash_message', 'Les informations ont été mises à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Cours)
    {
        Cours::find($Cours)->delete();
        return redirect('/cour/spectacle')->with('flash_message', "le cour est supprimée");
    }
}
