@extends('layouts.layout')
@section('title', 'Notes')
@section('content2')
    <div class="container mt-5">
        <div style="display: flex;" class="mb-5">
            <div style="width: 22%; font-size: 1.5rem" id="allAction">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div>
                <h1 class="text-center">Résultats du deuxième examens</h1>
            </div>
        </div>
        <div class="form-group col-md-4" >
            <label for="classSelect" id="allAction">Classe :</label>
            <select id="classSelect" class="form-select">
                @foreach ($classes as $class)
                    <option value="classe{{ $class->id_classe }}">{{ $class->nom_classe }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover tableNotes">
                
            </table>
        </div>
    </div>
    <script>
        const timetableData = {
            classe1: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Calcule</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                    </tr>
            @foreach ($AF1 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Calcule')
                                       <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Calcule']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                        <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
   
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
         
                    </td>
                </tr>
            @endforeach`,
            classe2: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Calcule</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AF2 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Calcule')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Calcule']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
    
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe3: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Calcule</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AF3 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Calcule')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Calcule']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
    
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe4: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Calcule</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AF4 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Calcule')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Calcule']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
    
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe5: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Calcule</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AF5 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Calcule')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Calcule']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
    
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe6: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AF6 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
    
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
              
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AF6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe7: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AS1 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                      
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS1Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe8: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AS2 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS2Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe9: `
            <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AS3 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                   
                    <td>
                 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
  
                    </td>
                    <td>
 
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
         
                    </td>
                    <td>

                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
           
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS3Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe10: `
                    <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AS4 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
                        
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS4Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe11: `
                    <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                        <th>التربية المدنية</th>
                        <th>التاريخ و الجغرافيا</th>
                    </tr>
            @foreach ($AS5 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
                        
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS5Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التاريخ و الجغرافيا')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التاريخ و الجغرافيا']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe12: `
                    <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                        <th>التربية المدنية</th>
                    </tr>
            @foreach ($AS6 as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS6Note as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية المدنية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية المدنية']) }}">Ajouter une note</a>
                            @endif
                        
                    </td>
                </tr>
            @endforeach`,
            classe13: `
                    <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                    </tr>
            @foreach ($AS7D as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7DNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,
            classe14: `
                    <tr>
                        <th>ID</th>
                        <th>Nom & Prenom</th>
                        <th>Mathématiques</th>
                        <th>التربية الإسلامية</th>
                        <th>اللغة العربية</th>
                        <th>Sciences naturelles</th>
                        <th>Français</th>
                        <th>Anglais</th>
                        <th>Physique Chimie</th>
                    </tr>
            @foreach ($AS7C as $item)
                <tr>
                    <td>
                        E{{ $item->id_etudiant }}
                        </td>
                    <td>
                            {{ $item->nom }} {{ $item->prenom }}
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Mathématiques')
                                <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' =>'Mathématiques']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'التربية الإسلامية')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                                <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'التربية الإسلامية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'اللغة العربية')
                                 <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'اللغة العربية']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Sciences naturelles')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Sciences naturelles']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Français')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Français']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Anglais')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Anglais']) }}">Ajouter une note</a>
                            @endif
                    </td>
                    <td>
                            @php
                                $noteExists = false;
                            @endphp
                            @foreach ($AS7CNote as $note)
                                @if ($note->id_etudiant === $item->id_etudiant && $note->matiere === 'Physique Chimie')
                                         <a href="{{ url('/note/' . $note->id_note . '/edit') }}"><span class="input-group-text" >{{ $note->note }}/20</span></a>
                                    @php
                                        $noteExists = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$noteExists)
                               <a class="note-link" id="allAction" href="{{ route('notes.create', ['id' => $item->id_etudiant,'type'=>'examen2', 'matiere' => 'Physique Chimie']) }}">Ajouter une note</a>
                            @endif
                    </td>
                </tr>
            @endforeach`,

        };

        // Function to update the tableNotes based on the selected class
        function updateTimetable(classValue) {
            const tableNotes = document.querySelector(".tableNotes");
            const timetableContent = timetableData[classValue];
            tableNotes.innerHTML = timetableContent;
        }

        // Listen for changes in the class select and update the tableNotes
        const classSelect = document.getElementById("classSelect");
        classSelect.addEventListener("change", () => {
            const selectedClass = classSelect.value;
            updateTimetable(selectedClass);
        });

        // Initial update to set the tableNotes based on the default selected class
        updateTimetable(classSelect.value);
    </script>
@endsection