@extends('layouts.dashboard')

@section('title', $classe->nom_classe)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $classe->nom_classe }}</li>
@endsection

@section('header-actions')
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('administrateur')))
        <a href="{{ route('classes.edit', $classe->id_classe) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endif
@endsection

@section('content')
    <!-- Class Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.etudiants_inscrits') }}</h6>
                            <h3 class="mb-0">{{ $classe->etudiants->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-book fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.cours_assignes') }}</h6>
                            <h3 class="mb-0">{{ $classe->cours->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clipboard-check fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.evaluations') }}</h6>
                            <h3 class="mb-0">{{ $classe->evaluations->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-level-up-alt fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.niveau') }}</h6>
                            <h3 class="mb-0">{{ $classe->niveau }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Class Details -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.details_classe') }}</h5>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.nom_classe') }}</div>
                        <div class="fw-bold">{{ $classe->nom_classe }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.niveau') }}</div>
                        <div class="fw-bold">{{ $classe->niveau }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.date_creation') }}</div>
                        <div>{{ $classe->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <div class="text-muted small mb-1">{{ __('app.date_modification') }}</div>
                        <div>{{ $classe->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">{{ __('app.etudiants_de_la_classe') }} ({{ $classe->etudiants->count() }})</h5>
                        @admin
                            <a href="{{ route('etudiants.create', ['classe' => $classe->id_classe]) }}" class="btn btn-sm btn-primary">
                                {{ __('app.ajouter_etudiant') }}
                            </a>
                        @endadmin
                    </div>
                    
                    @if($classe->etudiants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted fw-normal">{{ __('app.nom_complet') }}</th>
                                        <th class="text-muted fw-normal">{{ __('app.email') }}</th>
                                        <th class="text-muted fw-normal">{{ __('app.telephone') }}</th>
                                        <th class="text-muted fw-normal">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classe->etudiants as $student)
                                        <tr>
                                            <td>
                                                <strong>{{ $student->prenom }} {{ $student->nom }}</strong>
                                            </td>
                                            <td>
                                                @if($student->email)
                                                    <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                                        {{ $student->email }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->telephone)
                                                    <a href="tel:{{ $student->telephone }}" class="text-decoration-none">
                                                        {{ $student->telephone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('etudiants.show', $student) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    {{ __('app.voir') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-graduate fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">{{ __('app.aucun_etudiant_inscrit') }}</h5>
                            <p class="text-muted">{{ __('app.classe_sans_etudiants') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    @if($classe->cours->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.cours_de_la_classe') }} ({{ $classe->cours->count() }})</h5>
                    
                    <div class="row g-3">
                        @foreach($classe->cours as $cours)
                            <div class="col-md-4">
                                <div class="card border h-100">
                                    <div class="card-body">
                                        <h6 class="mb-2">{{ $cours->nom_cours }}</h6>
                                        <p class="text-muted small mb-3">
                                            {{ __('app.enseignant') }}: {{ $cours->enseignant?->nom_enseignant ?? 'Non assigné' }}
                                        </p>
                                        <a href="{{ route('cours.show', $cours->id_cours) }}" class="btn btn-sm btn-outline-primary w-100">
                                            {{ __('app.voir_le_cours') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
