<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Support\Facades\DB;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('note.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id, string $matiere,string $type)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::find($id); // Retrieve the student using the provided ID
        return view('note.create', compact('etudiant', 'classes', 'matiere','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Note::create($input);
       
        $type=$input['type'];
        if ($type == 'devoir1') {
            return redirect('/note/noteDevoir1')->with('flash_message', "le note de l'etudiant a été ajouté");
        } elseif($type == 'devoir2') {
            return redirect('/note/noteDevoir2')->with('flash_message', "le note de l'etudiant a été ajouté");
        } elseif($type == 'devoir3') {
            return redirect('/note/noteDevoir3')->with('flash_message', "le note de l'etudiant a été ajouté");
        }elseif ($type == 'examen1') {
            return redirect('/note/noteExamen1')->with('flash_message', "le note de l'etudiant a été ajouté");
        } elseif($type == 'examen2') {
            return redirect('/note/noteExamen2')->with('flash_message', "le note de l'etudiant a été ajouté");
        } elseif($type == 'examen3') {
            return redirect('/note/noteExamen3')->with('flash_message', "le note de l'etudiant a été ajouté");
        }
      
    }



    /**
     * Display the specified resource.
     */
    public function showNoteDevoir1(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'devoir1')->where('id_classe', 14)->get();
        return view('note.noteDevoir1', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }
    public function showNoteDevoir2(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'devoir2')->where('id_classe', 14)->get();
        return view('note.noteDevoir2', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }
    public function showNoteDevoir3(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'devoir3')->where('id_classe', 14)->get();
        return view('note.noteDevoir3', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }
    public function showNoteExamen1(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'examen1')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'examen1')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'examen1')->where('id_classe', 14)->get();
        return view('note.noteExamen1', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }
    public function showNoteExamen2(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'examen2')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'examen2')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'examen2')->where('id_classe', 14)->get();
        return view('note.noteExamen2', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }
    public function showNoteExamen3(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        $AF1Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 1)->get();
        $AF2Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 2)->get();
        $AF3Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 3)->get();
        $AF4Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 4)->get();
        $AF5Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 5)->get();
        $AF6Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 6)->get();
        $AS1Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 7)->get();
        $AS2Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 8)->get();
        $AS3Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 9)->get();
        $AS4Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 10)->get();
        $AS5Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 11)->get();
        $AS6Note = DB::table('notes')->where('type', 'examen3')->where('id_classe', 12)->get();
        $AS7DNote = DB::table('notes')->where('type', 'examen3')->where('id_classe', 13)->get();
        $AS7CNote = DB::table('notes')->where('type', 'examen3')->where('id_classe', 14)->get();
        return view('note.noteExamen3', compact('etudiant', 'classes'))->with('AF1', $AF1)->with('AF2', $AF2)->with('AF3', $AF3)->with('AF4', $AF4)->with('AF5', $AF5)->with('AF6', $AF6)->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C)->with('AF1Note', $AF1Note)->with('AF2Note', $AF2Note)->with('AF3Note', $AF3Note)->with('AF4Note', $AF4Note)->with('AF5Note', $AF5Note)->with('AF6Note', $AF6Note)->with('AS1Note', $AS1Note)->with('AS2Note', $AS2Note)->with('AS3Note', $AS3Note)->with('AS4Note', $AS4Note)->with('AS5Note', $AS5Note)->with('AS6Note', $AS6Note)->with('AS7DNote', $AS7DNote)->with('AS7CNote', $AS7CNote);
    }

    public function showreleveNotes1(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        return view('note.releveNotes1', compact('etudiant', 'classes'))->with('AF1',$AF1)->with('AF2',$AF2)->with('AF3',$AF3)->with('AF4',$AF4)->with('AF5',$AF5)->with('AF6',$AF6)
        ->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C);
    }

    public function spectacleT1(string $id,string $trimestre)
    {
        $etudiant = Etudiant::find($id);
        $devoire1 = DB::table('notes')->where('type', 'devoir1')->where('id_etudiant',$id)->get();
        $examen1 = DB::table('notes')->where('type', 'examen1')->where('id_etudiant',$id)->get();
        return view('note.spectacle',compact('trimestre'))->with('devoire1',$devoire1)->with('examen1',$examen1)->with('etudiant',$etudiant);
    }

    public function showreleveNotes2(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        return view('note.releveNotes2', compact('etudiant', 'classes'))->with('AF1',$AF1)->with('AF2',$AF2)->with('AF3',$AF3)->with('AF4',$AF4)->with('AF5',$AF5)->with('AF6',$AF6)
        ->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C);
    }
    
    public function spectacleT2(string $id,string $trimestre)
    {
        $etudiant = Etudiant::find($id);
        $devoire1 = DB::table('notes')->where('type', 'devoir2')->where('id_etudiant',$id)->get();
        $examen1 = DB::table('notes')->where('type', 'examen2')->where('id_etudiant',$id)->get();
        return view('note.spectacle',compact('trimestre'))->with('devoire1',$devoire1)->with('examen1',$examen1)->with('etudiant',$etudiant);
    }


    public function showreleveNotes3(string $note=null)
    {
        $classes = Classe::all();
        $etudiant = Etudiant::all(); // Retrieve all classes from the Classe model
        $AF1 = DB::table('etudiants')->where('id_classe', 1)->get();
        $AF2 = DB::table('etudiants')->where('id_classe', 2)->get();
        $AF3 = DB::table('etudiants')->where('id_classe', 3)->get();
        $AF4 = DB::table('etudiants')->where('id_classe', 4)->get();
        $AF5 = DB::table('etudiants')->where('id_classe', 5)->get();
        $AF6 = DB::table('etudiants')->where('id_classe', 6)->get();
        $AS1 = DB::table('etudiants')->where('id_classe', 7)->get();
        $AS2 = DB::table('etudiants')->where('id_classe', 8)->get();
        $AS3 = DB::table('etudiants')->where('id_classe', 9)->get();
        $AS4 = DB::table('etudiants')->where('id_classe', 10)->get();
        $AS5 = DB::table('etudiants')->where('id_classe', 11)->get();
        $AS6 = DB::table('etudiants')->where('id_classe', 12)->get();
        $AS7D = DB::table('etudiants')->where('id_classe', 13)->get();
        $AS7C = DB::table('etudiants')->where('id_classe', 14)->get();
        return view('note.releveNotes3', compact('etudiant', 'classes'))->with('AF1',$AF1)->with('AF2',$AF2)->with('AF3',$AF3)->with('AF4',$AF4)->with('AF5',$AF5)->with('AF6',$AF6)
        ->with('AS1', $AS1)->with('AS2', $AS2)->with('AS3', $AS3)->with('AS4', $AS4)->with('AS5', $AS5)->with('AS6', $AS6)->with('AS7D', $AS7D)->with('AS7C', $AS7C);
    }

    public function spectacleT3(string $id,string $trimestre)
    {
        $etudiant = Etudiant::find($id);
        $devoire1 = DB::table('notes')->where('type', 'devoir3')->where('id_etudiant',$id)->get();
        $examen1 = DB::table('notes')->where('type', 'examen3')->where('id_etudiant',$id)->get();
        return view('note.spectacle',compact('trimestre'))->with('devoire1',$devoire1)->with('examen1',$examen1)->with('etudiant',$etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $note)
    {

        $etudiants = Etudiant::all();
        $classes = Classe::all();

        $note = Note::find($note);
        if (!$note) {
            return redirect()->back()->with('flash_message', 'note introuvable');
        }
        foreach ($etudiants as $dd) {
            if ($dd->id_etudiant === $note->id_etudiant) {
                foreach ($classes as $ddd) {
                    if ($ddd->id_classe === $dd->id_classe) {
                        $classes =  Classe::find($ddd->id_classe);
                        $etudiants = Etudiant::find($dd->id_etudiant);
                        return view('note.edit', compact('note', 'etudiants'))->with('etudiants', $etudiants)->with('classes', $classes);
                    }
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $note)
    {
        $noteRecord = Note::find($note);
        
        if (!$noteRecord) {
            return redirect()->back()->with('error', 'Note non trouvée.');
        }
        
        // Validate the request
        $request->validate([
            'note' => 'required|numeric|min:0',
            'id_evaluation' => 'required|exists:evaluations,id_evaluation',
            'id_etudiant' => 'required|exists:etudiants,id_etudiant'
        ]);
        
        // Check if coming from grade entry page
        if ($request->has('from_saisir_notes')) {
            $noteRecord->update([
                'note' => $request->note,
                'id_evaluation' => $request->id_evaluation,
                'id_etudiant' => $request->id_etudiant
            ]);
            
            return redirect()->route('saisir-notes')->with('success', 'Note mise à jour avec succès!');
        }
        
        // Legacy update logic for other pages
        $type = $noteRecord->type;
        $input = $request->all();
        $noteRecord->update($input);
        
        if ($type == 'devoir1') {
            return redirect('/note/noteDevoir1')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'devoir2') {
            return redirect('/note/noteDevoir2')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'devoir3') {
            return redirect('/note/noteDevoir3')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'examen1') {
            return redirect('/note/noteExamen1')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'examen2') {
            return redirect('/note/noteExamen2')->with('flash_message', 'Les informations ont été mises à jour!');
        }elseif ($type == 'examen3') {
            return redirect('/note/noteExamen3')->with('flash_message', 'Les informations ont été mises à jour!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $note)
    {
        
        $note=Note::find($note);
        $type=$note->type;
        $note->delete();
        if ($type == 'devoir1') {
            return redirect('/note/noteDevoir1')->with('flash_message', "Note supprimée");
        }elseif($type == 'devoir2') {
            return redirect('/note/noteDevoir2')->with('flash_message', "Note supprimée");
        } elseif($type == 'devoir3') {
            return redirect('/note/noteDevoir3')->with('flash_message', "Note supprimée");
        }elseif ($type == 'examen1') {
            return redirect('/note/noteExamen1')->with('flash_message', "Note supprimée");
        } elseif($type == 'examen2') {
            return redirect('/note/noteExamen2')->with('flash_message', "Note supprimée");
        } elseif($type == 'examen3') {
            return redirect('/note/noteExamen3')->with('flash_message', "Note supprimée");
        }
    }
}
