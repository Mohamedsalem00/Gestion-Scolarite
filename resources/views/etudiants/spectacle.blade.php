@extends('layouts.layout')
@section('title', 'Spectacle')
@section('content2')

    <div id="content">
        <div class="card" style="margin: 20px;">
            <div class="card-header" id="allAction">
                <div style="display: flex;">
                    <div style="width: 43%; font-size: 1.5rem">
                        <a href="{{ url('/etudiant') }}" title="retourne" id="retourne"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div style="width: 53%">
                        <h4>Page étudiant</h4>
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
                                                <h3>{{ $etudiants->nom }} {{ $etudiants->prenom }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0"><strong class="pr-1">Matricule: </strong>
                                                    E{{ $etudiants->id_etudiant }}
                                                </p>
                                                <p class="mb-0"><strong class="pr-1">Classe:
                                                    </strong>{{ $etudiants->classe->niveau }}</p>
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
                                                        <th width="30%">Telephone</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $etudiants->telephone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Date de naissance</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $etudiants->date_naissance }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Date d'inscription</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $etudiants->created_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Adresse</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $etudiants->adresse }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">Genre</th>
                                                        <td width="2%">:</td>
                                                        <td>{{ $etudiants->genre }}</td>
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
    <script></script>
@endsection
