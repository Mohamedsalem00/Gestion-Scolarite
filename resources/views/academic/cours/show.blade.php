@extends('layouts.dashboard')

@section('title', $cours->nom_cours)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ $cours->nom_cours }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('cours.edit', $cours) }}" class="btn btn-warning">
                {{ __('app.modifier') }}
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                {{ __('app.supprimer') }}
            </button>
        @endadmin
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Course Details -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.details_cours') }}</h5>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.nom_cours') }}</div>
                        <div class="fw-bold">{{ $cours->nom_cours }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.matiere') }}</div>
                        <div>{{ $cours->matiere->nom_matiere ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.classe') }}</div>
                        <div>{{ $cours->classe->nom_classe ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.enseignant') }}</div>
                        <div>{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.jour') }}</div>
                        <div class="text-capitalize">{{ $cours->jour }}</div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.horaire') }}</div>
                        <div>
                            @if($cours->date_debut && $cours->date_fin)
                                {{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="text-muted small mb-1">{{ __('app.duree') }}</div>
                        <div>
                            @if($cours->date_debut && $cours->date_fin)
                                {{ \Carbon\Carbon::parse($cours->date_debut)->diffInMinutes(\Carbon\Carbon::parse($cours->date_fin)) }} {{ __('app.minutes') }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-muted small mb-1">{{ __('app.salle') }}</div>
                        <div>{{ $cours->salle ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('app.liens_rapides') }}</h6>
                    <div class="d-grid gap-2">
                        @if($cours->classe)
                            <a href="{{ route('classes.show', $cours->classe) }}" class="btn btn-sm btn-outline-primary">
                                {{ __('app.voir_classe') }}
                            </a>
                        @endif
                        @if($cours->enseignant)
                            <a href="{{ route('enseignants.show', $cours->enseignant) }}" class="btn btn-sm btn-outline-success">
                                {{ __('app.voir_enseignant') }}
                            </a>
                        @endif
                        <a href="{{ route('cours.spectacle') }}?classe={{ $cours->id_classe }}" class="btn btn-sm btn-outline-info">
                            {{ __('app.voir_emploi_temps') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Description -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.description') }}</h5>
                    
                    @if($cours->description)
                        <p class="text-muted">{{ $cours->description }}</p>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">{{ __('app.aucune_description') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Course Information Summary -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.resume') }}</h5>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-book fa-lg text-primary me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">{{ __('app.matiere') }}</h6>
                                    <p class="text-muted mb-0">{{ $cours->matiere->nom_matiere ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-users fa-lg text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">{{ __('app.classe') }}</h6>
                                    <p class="text-muted mb-0">{{ $cours->classe->nom_classe ?? 'N/A' }}</p>
                                    <small class="text-muted">{{ $cours->classe->etudiants->count() ?? 0 }} {{ __('app.etudiants') }}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-chalkboard-teacher fa-lg text-info me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">{{ __('app.enseignant') }}</h6>
                                    <p class="text-muted mb-0">{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-calendar-alt fa-lg text-warning me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">{{ __('app.planning') }}</h6>
                                    <p class="text-muted mb-0 text-capitalize">{{ $cours->jour }}</p>
                                    <small class="text-muted">
                                        @if($cours->date_debut && $cours->date_fin)
                                            {{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('app.confirmer_suppression') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression_cours') }}
                </div>
                <p>{{ __('app.cours') }}: <strong>{{ $cours->nom_cours }}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.annuler') }}</button>
                <form action="{{ route('cours.destroy', $cours) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('app.supprimer') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
