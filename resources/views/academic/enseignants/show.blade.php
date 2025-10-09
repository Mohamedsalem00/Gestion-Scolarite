@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.voir') }} - {{ $enseignants->prenom }} {{ $enseignants->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    @admin
        <a href="{{ route('enseignants.edit', $enseignants->id_enseignant) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Summary -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ substr($enseignants->prenom, 0, 1) }}{{ substr($enseignants->nom, 0, 1) }}
                    </div>
                    <h4 class="card-title mb-1">{{ $enseignants->prenom }} {{ $enseignants->nom }}</h4>
                    <p class="text-muted mb-3">{{ $enseignants->matiere }}</p>
                    
                    <div class="text-center mb-3">
                        <span class="badge bg-primary fs-6">{{ __('app.enseignant') }}</span>
                    </div>

                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="mb-1 text-primary">{{ $enseignants->id_enseignant }}</h5>
                                <small class="text-muted">ID Enseignant</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-1 text-success">
                                {{ $enseignants->classe ? $enseignants->classe->nom_classe : 'N/A' }}
                            </h5>
                            <small class="text-muted">Classe assignée</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.informations_personnelles') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.nom_complet') }}</label>
                            <p class="fw-bold">{{ $enseignants->prenom }} {{ $enseignants->nom }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.email') }}</label>
                            <p>
                                <a href="mailto:{{ $enseignants->email }}" class="text-decoration-none">
                                    {{ $enseignants->email }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.telephone') }}</label>
                            <p>
                                <a href="tel:{{ $enseignants->telephone }}" class="text-decoration-none">
                                    {{ $enseignants->telephone }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.matiere_enseignee') }}</label>
                            <p>
                                <span class="badge bg-primary fs-6">{{ $enseignants->matiere }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.classe_assignee') }}</label>
                            <p>
                                @if($enseignants->classe)
                                    <span class="badge bg-secondary fs-6">
                                        {{ $enseignants->classe->nom_classe }}
                                    </span>
                                @else
                                    <span class="text-muted">{{ __('app.aucune_classe_assignee') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('app.date_ajout') }}</label>
                            <p>
                                {{ $enseignants->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.activite_pedagogique') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h4 class="text-info mb-1">0</h4>
                                <small class="text-muted">{{ __('app.cours_dispenses') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h4 class="text-warning mb-1">0</h4>
                                <small class="text-muted">{{ __('app.evaluations_creees') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="text-success mb-1">{{ $enseignants->classe ? $enseignants->classe->etudiants()->count() : 0 }}</h4>
                            <small class="text-muted">{{ __('app.etudiants') }}</small>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <blockquote class="blockquote">
                            <p class="mb-0 fst-italic text-muted">
                                "{{ __('app.mission_educative_quote') }}"
                            </p>
                            <footer class="blockquote-footer mt-2">
                                {{ __('app.mission_educative') }}
                            </footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
