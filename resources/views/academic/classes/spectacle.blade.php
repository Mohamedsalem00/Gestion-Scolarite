@extends('layouts.layout')
@section('title','Spectacle')
@section('content2')
    <div class="container mt-5">
        <div style="width: 38%; font-size: 1.5rem">
            <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
        </div>
        <div class="card p-4">
            <h1 class="text-center">Information sur la classe</h1>
            <div class="card-body">
                <h3>Classe:<small> {{ $classes->nom_classe }}</small></h3>
                <h3>Etudiants:</h3>             
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Matricule</th>
                        <th width="30%">Nom & Prenom</th>
                    </tr>
                    @forelse ($classes->etudiants as $item)
                        <tr>
                            <td>{{$item->id_etudiant}}</td>
                            
                            
                            <td>{{ $item->nom }} {{ $item->prenom }}</td>
                        </tr>
                    @empty
                        <li class="list-group-item">Aucun etudiant trouvé.</li>
                        <style>
                            table {
                                display: none;
                            }
                        </style>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
