<?php

namespace App\Http\Controllers;

use App\Models\Evoluation;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;


class EvoluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $evoluation1AF = DB::table('evoluations')->where('id_classe', 1)->get();
        $evoluation = Evoluation::all();
        return view('evoluation.index')->with('evoluation', $evoluation)->with('evoluation1AF', $evoluation1AF);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        return view('evoluation.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Evoluation::create($input);
        $type=$input['type'];
        if ($type == 'devoir1') {
            return redirect('/evoluation/spectacleDevoir1')->with('flash_message', "l'evoluation a été ajoutée");
        } elseif($type == 'devoir2') {
            return redirect('/evoluation/spectacleDevoir2')->with('flash_message', "l'evoluation a été ajoutée");
        } elseif($type == 'devoir3') {
            return redirect('/evoluation/spectacleDevoir3')->with('flash_message', "l'evoluation a été ajoutée");
        }elseif ($type == 'examen1') {
            return redirect('/evoluation/spectacleExamen1')->with('flash_message', "l'evoluation a été ajoutée");
        } elseif($type == 'examen2') {
            return redirect('/evoluation/spectacleExamen2')->with('flash_message', "l'evoluation a été ajoutée");
        } elseif($type == 'examen3') {
            return redirect('/evoluation/spectacleExamen3')->with('flash_message', "l'evoluation a été ajoutée");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];
        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir1')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir1')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir1')->where('id_classe', 14)->get();
        return view('evoluation.spectacleDevoir1')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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
    
    public function show2(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];

        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir2')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir2')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir2')->where('id_classe', 14)->get();
        return view('evoluation.spectacleDevoir2')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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

    public function show3(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];

        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'devoir3')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'devoir3')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'devoir3')->where('id_classe', 14)->get();
        return view('evoluation.spectacleDevoir3')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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

    public function show4(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];

        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen1')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen1')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen1')->where('id_classe', 14)->get();
        return view('evoluation.spectacleExamen1')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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

    public function show5(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];

        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen2')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen2')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen2')->where('id_classe', 14)->get();
        return view('evoluation.spectacleExamen2')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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

    public function show6(string $evoluation=null)
    {
        $joursSemaine = [
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi'
        ];

        
        $evoluation = Evoluation::find($evoluation);
        $classe = Classe::all();
        $debut08 = Evoluation::where('hDebut', '08:00:00')->first();
        $debut10 = Evoluation::where('hDebut', '10:00:00')->first();
        $debut12 = Evoluation::where('hDebut', '12:00:00')->first();
        $fine12 = Evoluation::where('hFine', '12:00:00')->first();
        $fine14 = Evoluation::where('hFine', '14:00:00')->first();
        $fine10 = Evoluation::where('hFine', '10:00:00')->first();
        $debutinfo1AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 1)->get();
        $milieuinfo1AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 1)->get();
        $fineinfo1AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 1)->get();
        $debutinfo2AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 2)->get();
        $milieuinfo2AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 2)->get();
        $fineinfo2AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 2)->get();
        $debutinfo3AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 3)->get();
        $milieuinfo3AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 3)->get();
        $fineinfo3AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 3)->get();
        $debutinfo4AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 4)->get();
        $milieuinfo4AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 4)->get();
        $fineinfo4AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 4)->get();
        $debutinfo5AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 5)->get();
        $milieuinfo5AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 5)->get();
        $fineinfo5AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 5)->get();
        $debutinfo6AF = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 6)->get();
        $milieuinfo6AF = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 6)->get();
        $fineinfo6AF = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 6)->get();
        $debutinfo1AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 7)->get();
        $milieuinfo1AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 7)->get();
        $fineinfo1AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 7)->get();
        $debutinfo2AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 8)->get();
        $milieuinfo2AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 8)->get();
        $fineinfo2AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 8)->get();
        $debutinfo3AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 9)->get();
        $milieuinfo3AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 9)->get();
        $fineinfo3AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 9)->get();
        $debutinfo4AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 10)->get();
        $milieuinfo4AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 10)->get();
        $fineinfo4AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 10)->get();
        $debutinfo5AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 11)->get();
        $milieuinfo5AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 11)->get();
        $fineinfo5AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 11)->get();
        $debutinfo6AS = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 12)->get();
        $milieuinfo6AS = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 12)->get();
        $fineinfo6AS = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 12)->get();
        $debutinfo7ASD = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 13)->get();
        $milieuinfo7ASD = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 13)->get();
        $fineinfo7ASD = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 13)->get();
        $debutinfo7ASC = DB::table('evoluations')->where('hDebut', '08:00:00')->where('type', 'examen3')->where('id_classe', 14)->get();
        $milieuinfo7ASC = DB::table('evoluations')->where('hDebut', '10:00:00')->where('type', 'examen3')->where('id_classe', 14)->get();
        $fineinfo7ASC = DB::table('evoluations')->where('hDebut', '12:00:00')->where('type', 'examen3')->where('id_classe', 14)->get();
        return view('evoluation.spectacleExamen3')->with('evoluation', $evoluation)->with('classe', $classe)->with('joursSemaine', $joursSemaine)->
        with(['debut08' => $debut08])->with(['debut10' => $debut10])->with(['debut12' => $debut12])->
        with(['fine10' => $fine10])->with(['fine12' => $fine12])->with(['fine14' => $fine14])->
        with(['debutinfo1AF' => $debutinfo1AF])->with(['milieuinfo1AF' => $milieuinfo1AF])->with(['fineinfo1AF' => $fineinfo1AF])->
        with(['debutinfo2AF' => $debutinfo2AF])->with(['milieuinfo2AF' => $milieuinfo2AF])->with(['fineinfo2AF' => $fineinfo2AF])->
        with(['debutinfo3AF' => $debutinfo3AF])->with(['milieuinfo3AF' => $milieuinfo3AF])->with(['fineinfo3AF' => $fineinfo3AF])->
        with(['debutinfo4AF' => $debutinfo4AF])->with(['milieuinfo4AF' => $milieuinfo4AF])->with(['fineinfo4AF' => $fineinfo4AF])->
        with(['debutinfo5AF' => $debutinfo5AF])->with(['milieuinfo5AF' => $milieuinfo5AF])->with(['fineinfo5AF' => $fineinfo5AF])->
        with(['debutinfo6AF' => $debutinfo6AF])->with(['milieuinfo6AF' => $milieuinfo6AF])->with(['fineinfo6AF' => $fineinfo6AF])->
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
    public function edit(Evoluation $evoluation)
    {
        $classes = Classe::all();
        if (!$evoluation) {
            return redirect()->back()->with('flash_message', 'evoluation introuvable');
        }

        return view('evoluation.edit', compact('evoluation', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $evoluation)
    {
        $evoluation = Evoluation::find($evoluation);
        $type=$evoluation->type;
        $input = $request->all();
        $evoluation->update($input);
        if ($type == 'devoir1') {
            return redirect('/evoluation/spectacleDevoir1')->with('flash_message', 'Les informations ont été mises à jour!');
        } elseif($type == 'devoir2') {
            return redirect('/evoluation/spectacleDevoir2')->with('flash_message', 'Les informations ont été mises à jour!');
        } elseif($type == 'devoir3') {
            return redirect('/evoluation/spectacleDevoir3')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'examen1') {
            return redirect('/evoluation/spectacleExamen1')->with('flash_message', 'Les informations ont été mises à jour!');
        } elseif($type == 'examen2') {
            return redirect('/evoluation/spectacleExamen2')->with('flash_message', 'Les informations ont été mises à jour!');
        } elseif($type == 'examen3') {
            return redirect('/evoluation/spectacleExamen3')->with('flash_message', 'Les informations ont été mises à jour!');
        }

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $evoluation)
    {
        $evoluation=Evoluation::find($evoluation);
        $type=$evoluation->type;
        $evoluation->delete();
        if ($type == 'devoir1') {
            return redirect('/evoluation/spectacleDevoir1')->with('flash_message', "l'evoluation est supprimé");
        } elseif($type == 'devoir2') {
            return redirect('/evoluation/spectacleDevoir2')->with('flash_message', "l'evoluation est supprimé");
        } elseif($type == 'devoir3') {
            return redirect('/evoluation/spectacleDevoir3')->with('flash_message', "l'evoluation est supprimé");
        }elseif ($type == 'examen1') {
            return redirect('/evoluation/spectacleExamen1')->with('flash_message', "l'evoluation est supprimé");
        } elseif($type == 'examen2') {
            return redirect('/evoluation/spectacleExamen2')->with('flash_message', "l'evoluation est supprimé");
        } elseif($type == 'examen3') {
            return redirect('/evoluation/spectacleExamen3')->with('flash_message', "l'evoluation est supprimé");
        }
    }
}
