@extends('layouts.dashboard')

@section('title', __('app.voir_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.voir') }} - {{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    @admin
        <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endadmin
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                        </div>
                    </div>
                    <h4 class="card-title">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                    <p class="text-muted">{{ __('app.matricule') }}: {{ $etudiant->matricule }}</p>
                    <p class="text-muted">{{ __('app.classe') }}: {{ $etudiant->classe?->nom_classe ?? 'Non assigné' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('app.informations_generales') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th class="text-muted" style="width: 30%;">{{ __('app.telephone') }}</th>
                                    <td>{{ $etudiant->telephone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">{{ __('app.email') }}</th>
                                    <td>{{ $etudiant->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">{{ __('app.date_naissance') }}</th>
                                    <td>{{ $etudiant->date_naissance ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">{{ __('app.date_inscription') }}</th>
                                    <td>{{ $etudiant->created_at->format('d/m/Y à H:i') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">{{ __('app.adresse') }}</th>
                                    <td>{{ $etudiant->adresse ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">{{ __('app.genre') }}</th>
                                    <td>{{ ucfirst($etudiant->genre ?? 'N/A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
