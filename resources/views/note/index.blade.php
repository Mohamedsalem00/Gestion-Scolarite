@extends('layouts.layout')
@section('title', 'Notes')
@section('content2')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Résultats des devoirs</h5>
                        <ul class="list-group">
                            <a href="{{ route('noteDevoir1') }}">
                                <li class="list-group-item"> Devoir 1</li>
                            </a>
                            <a href="{{ route('noteDevoir2') }}">
                                <li class="list-group-item"> Devoir 2</li>
                            </a>
                            <a href="{{ route('noteDevoir3') }}">
                                <li class="list-group-item"> Devoir 3</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Résultats des examens</h5>
                        <ul class="list-group">
                            <a href="{{ route('noteExamen1') }}">
                                <li class="list-group-item"> Examen 1</li>
                            </a>
                            <a href="{{ route('noteExamen2') }}">
                                <li class="list-group-item"> Examen 2</li>
                            </a>
                            <a href="{{ route('noteExamen3') }}">
                                <li class="list-group-item"> Examen 3</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Releve de notes</h5>
                        <ul class="list-group">
                            <a href="{{ route('releveNotes1') }}">
                                <li class="list-group-item">Premier trimestre</li>
                            </a>
                            <a href="{{ route('releveNotes2') }}">
                                <li class="list-group-item">Deuxième trimestre</li>
                            </a>
                            <a href="{{ route('releveNotes3') }}">
                                <li class="list-group-item">Troisième trimestre</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
