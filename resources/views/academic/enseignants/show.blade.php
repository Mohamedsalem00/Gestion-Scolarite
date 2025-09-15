@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.academic_management') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @can('create', App\Models\Enseignant::class)
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            {{ __('app.ajouter_enseignant') }}
        </a>
    @endcan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Summary -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="avatar-lg mx-auto mb-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person" style="font-size: 2rem;"></i>
                    </div>
                    <h4 class="card-title mb-1">{{ $enseignants->prenom }} {{ $enseignants->nom }}</h4>
                    <p class="text-muted mb-3">{{ $enseignants->matiere }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @can('update', $enseignants)
                        <a href="{{ route('enseignants.edit', $enseignants->id_enseignant) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil me-1"></i>
                            {{ __('Modifier') }}
                        </a>
                        @endcan
                        <a href="{{ route('enseignants.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>
                            {{ __('Retour') }}
                        </a>
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
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('Informations personnelles') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Nom complet') }}</label>
                            <p class="fw-bold">{{ $enseignants->prenom }} {{ $enseignants->nom }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Email') }}</label>
                            <p>
                                <a href="mailto:{{ $enseignants->email }}" class="text-decoration-none">
                                    <i class="bi bi-envelope me-1"></i>
                                    {{ $enseignants->email }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Téléphone') }}</label>
                            <p>
                                <a href="tel:{{ $enseignants->telephone }}" class="text-decoration-none">
                                    <i class="bi bi-telephone me-1"></i>
                                    {{ $enseignants->telephone }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Matière enseignée') }}</label>
                            <p>
                                <span class="badge bg-primary fs-6">{{ $enseignants->matiere }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Classe assignée') }}</label>
                            <p>
                                @if($enseignants->classe)
                                    <span class="badge bg-secondary fs-6">
                                        {{ $enseignants->classe->nom_classe }} (Niveau {{ $enseignants->classe->niveau }})
                                    </span>
                                @else
                                    <span class="text-muted">{{ __('Aucune classe assignée') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">{{ __('Date d\'ajout') }}</label>
                            <p>
                                <i class="bi bi-calendar me-1"></i>
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
                        <i class="bi bi-mortarboard me-2"></i>
                        {{ __('Activité pédagogique') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <x-cards.info-card 
                                title="Cours dispensés" 
                                value="0" 
                                icon="bi-book"
                                color="info" />
                        </div>
                        <div class="col-md-4 text-center">
                            <x-cards.info-card 
                                title="Évaluations créées" 
                                value="0" 
                                icon="bi-clipboard-check"
                                color="warning" />
                        </div>
                        <div class="col-md-4 text-center">
                            <x-cards.info-card 
                                title="Étudiants" 
                                value="{{ $enseignants->classe ? $enseignants->classe->etudiants()->count() : 0 }}" 
                                icon="bi-people"
                                color="success" />
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <blockquote class="blockquote text-center">
                            <p class="mb-0 fst-italic">
                                "{{ __('Autonomiser les esprits pour la grandeur - Où l\'apprentissage ne connaît pas de limites.') }}"
                            </p>
                            <footer class="blockquote-footer mt-2">
                                {{ __('Mission éducative') }}
                            </footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
