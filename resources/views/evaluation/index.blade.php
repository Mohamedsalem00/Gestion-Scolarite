@extends('layouts.layout')
@section('title', 'Evoluation')
@section('content2')
<div class="container mt-5">
    <div class="row">
        <h3>Evaluation de l'année 2023-2024</h3>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Devoirs</h5>
                    <ul class="list-group">
                        <a href="{{ route('spectacleDevoir1') }}"><li class="list-group-item"> Devoir 1</li></a>
                        <a href="{{ route('spectacleDevoir2') }}"><li class="list-group-item"> Devoir 2</li></a>
                        <a href="{{ route('spectacleDevoir3') }}"><li class="list-group-item"> Devoir 3</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Examens</h5>
                    <ul class="list-group">
                        <a href="{{ route('spectacleExamen1') }}"><li class="list-group-item"> Examen 1</li></a>
                        <a href="{{ route('spectacleExamen2') }}"><li class="list-group-item"> Examen 2</li></a>
                        <a href="{{ route('spectacleExamen3') }}"><li class="list-group-item"> Examen 3</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/evoluation/create') }}" class="btn btn-success btn-sm" title="Ajouter nouveau classe" id="allAction">
                <i class="bi bi-person-plus-fill"></i> Ajouter
            </a>
        </div>
    </div>
</div>
@endsection
