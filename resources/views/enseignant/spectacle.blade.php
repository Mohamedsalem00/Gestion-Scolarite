@extends('layouts.layout')
@section('title', 'Spectacle')
@section('content2')
    <div id="content">
        <div class="card" style="margin: 20px;">
            <div class="card-header" id="allAction">
                <div style="display: flex;">
                    <div style="width: 43%; font-size: 1.5rem">
                        <a href="{{ url('/enseignant') }}" title="retourne" id="retourne"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div style="width: 50%">
                        <h4>Page enseignant</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-rt-12">
                    <div class="Scriptcontent">
                        <div class="student-profile py-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-transparent text-center">
                                                <img class="profile_img" src="{{ asset('img/prifile.png') }}"
                                                    alt="student dp">
                                                <h3>{{ $enseignants->nom }} {{ $enseignants->prenom }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0"><strong class="pr-1">Enseignant ID:</strong>
                                                    A{{$enseignants->id_enseignant}}
                                                </p>
                                                <p class="mb-0"><strong class="pr-1">Classe enseigne:</strong>
                                                    {{ $enseignants->classe->niveau }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-transparent border-0">
                                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Information général</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="30%">Matière enseignée</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $enseignants->matiere }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Téléphone</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $enseignants->telephone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Email</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $enseignants->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Date d'inscription</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $enseignants->created_at }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div style="height: 26px"></div>
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-transparent border-0">
                                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i></h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <p>"Autonomiser les esprits pour la grandeur - Où l'apprentissage ne connaît
                                                    pas de limites."
                                                    "Libérer le potentiel, façonner l'avenir - Notre dévouement à la
                                                    réussite des étudiants."
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
