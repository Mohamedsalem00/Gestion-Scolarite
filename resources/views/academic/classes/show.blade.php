@extends('layouts.dashboard')

@section('title', $classe->nom_classe)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $classe->nom_classe }}</li>
@endsection

@section('header-actions')
    @can('update', $classe)
        <a href="{{ route('classes.edit', $classe->id_classe) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>
            {{ __('app.edit') }}
        </a>
    @endcan
@endsection

@section('content')
    <!-- Class Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-cards.info-card
                title="Étudiants Inscrits"
                :value="$classe->etudiants->count()"
                icon="fas fa-user-graduate"
                color="primary"
                :href="route('etudiants.index', ['classe' => $classe->id_classe])"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Cours Assignés"
                :value="$classe->cours->count()"
                icon="fas fa-book"
                color="success"
                :href="route('cours.index', ['classe' => $classe->id_classe])"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Évaluations"
                :value="$classe->evaluations->count()"
                icon="fas fa-clipboard-check"
                color="info"
                :href="route('evaluations.index', ['classe' => $classe->id_classe])"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Niveau"
                :value="$classe->niveau"
                icon="fas fa-level-up-alt"
                color="warning"
            />
        </div>
    </div>

    <div class="row">
        <!-- Class Details -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __('app.details_classe') }}
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>{{ __('app.classe_nom') }}:</strong></td>
                            <td>{{ $classe->nom_classe }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('app.niveau') }}:</strong></td>
                            <td>{{ $classe->niveau }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('app.date_creation') }}:</strong></td>
                            <td>{{ $classe->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('app.date_modification') }}:</strong></td>
                            <td>{{ $classe->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        {{ __('app.etudiants_de_la_classe') }} ({{ $classe->etudiants->count() }})
                    </h5>
                    @can('create', App\Models\Etudiant::class)
                        <a href="{{ route('etudiants.create', ['classe' => $classe->id_classe]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-user-plus me-2"></i>
                            {{ __('app.ajouter_etudiant') }}
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    @if($classe->etudiants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.nom_complet') }}</th>
                                        <th>{{ __('app.email') }}</th>
                                        <th>{{ __('app.telephone') }}</th>
                                        <th>{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classe->etudiants as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                    <strong>{{ $student->prenom }} {{ $student->nom }}</strong>
                                                </div>
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
                                                <a href="{{ route('etudiants.show', $student->id_etudiant) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="{{ __('app.voir_details') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-graduate text-muted" style="font-size: 3rem;"></i>
                            <h6 class="text-muted mt-2">{{ __('app.aucun_etudiant_inscrit') }}</h6>
                            <p class="text-muted small">{{ __('app.classe_pas_etudiants') }}</p>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i>
                        {{ __('app.cours_de_la_classe') }} ({{ $classe->cours->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($classe->cours as $cours)
                            <div class="col-md-4 mb-3">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $cours->nom_cours }}</h6>
                                        <p class="card-text small text-muted">
                                            {{ __('app.enseignant') }}: {{ $cours->enseignant?->nom_enseignant ?? 'Non assigné' }}
                                        </p>
                                        <a href="{{ route('cours.show', $cours->id_cours) }}" class="btn btn-sm btn-outline-primary">
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
