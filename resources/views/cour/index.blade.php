@extends('layouts.layout')
@section('title', 'Emplois')
@section('content2')
    <style>
        
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 18px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        @media screen and (max-width: 768px) {
        body {
            font-size: 16px;
        }

        .container {
            max-width: 506px;
            padding: 10px;
            font-size: 1px;
        }
    }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Ajouter</h2>
                        <p class="card-text">Ajouter une nouvelle leçon</p>
                        <a href="{{ url('/cour/create') }}" class="btn btn-primary">Ajouter</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Voir</h2>
                        <p class="card-text">Voir tous les horaires</p>
                        <a href="{{ url('/cour/spectacle') }}" class="btn btn-info">Voir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
