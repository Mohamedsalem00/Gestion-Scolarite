@extends('layouts.dashboard')

@section('title', __('app.details_evaluation'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">{{ __('app.evaluations') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.details') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('evaluations.edit', $evaluation->id_evaluation) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>
                {{ __('app.modifier') }}
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash me-1"></i>
                {{ __('app.supprimer') }}
            </button>
        @endadmin
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Evaluation Details -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">{{ __('app.details_evaluation') }}</h5>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-2 d-block">{{ __('app.matiere') }}</label>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded px-2 py-1 me-2">
                                <i class="fas fa-book text-primary small"></i>
                            </div>
                            <span class="fw-semibold">{{ $evaluation->matiere_name }}</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-2 d-block">{{ __('app.type') }}</label>
                        @if($evaluation->type == 'examen')
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">
                                <i class="fas fa-file-alt me-1"></i>{{ ucfirst($evaluation->type) }}
                            </span>
                        @elseif($evaluation->type == 'controle')
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">
                                <i class="fas fa-edit me-1"></i>{{ ucfirst($evaluation->type) }}
                            </span>
                        @else
                            <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                <i class="fas fa-tasks me-1"></i>{{ ucfirst($evaluation->type) }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-2 d-block">{{ __('app.classe') }}</label>
                        @if($evaluation->classe)
                            <span class="badge rounded-pill bg-light text-dark border">{{ $evaluation->classe->nom_classe }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-2 d-block">{{ __('app.date') }}</label>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                        </span>
                    </div>

                    @php
                        $startTime = $evaluation->date_debut ? \Carbon\Carbon::parse($evaluation->date_debut)->format('H:i') : null;
                        $endTime = $evaluation->date_fin ? \Carbon\Carbon::parse($evaluation->date_fin)->format('H:i') : null;
                        $hasValidStart = $startTime && $startTime != '00:00';
                        $hasValidEnd = $endTime && $endTime != '00:00';
                    @endphp

                    @if($hasValidStart || $hasValidEnd)
                        <div class="mb-3 pb-3 border-bottom">
                            <label class="text-muted small mb-2 d-block">{{ __('app.horaire') }}</label>
                            <div class="d-flex gap-2">
                                @if($hasValidStart)
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-clock me-1"></i>{{ $startTime }}
                                    </span>
                                @endif
                                @if($hasValidEnd)
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        <i class="fas fa-clock me-1"></i>{{ $endTime }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="mb-0">
                        <label class="text-muted small mb-2 d-block">{{ __('app.note_max') }}</label>
                        <span class="badge bg-info bg-opacity-10 text-info">
                            <i class="fas fa-star me-1"></i>{{ $evaluation->note_max }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">{{ __('app.statistiques') }}</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="text-muted small mb-1">{{ __('app.total_etudiants') }}</div>
                                <div class="h3 mb-0 fw-bold text-primary">{{ $evaluation->notes->count() }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="text-muted small mb-1">{{ __('app.moyenne') }}</div>
                                <div class="h3 mb-0 fw-bold text-success">
                                    {{ $evaluation->notes->avg('note') ? number_format($evaluation->notes->avg('note'), 2) : '—' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Notes -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">{{ __('app.notes_etudiants') }}</h5>
                    
                    @if($evaluation->notes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted fw-normal small" style="width: 50px;">#</th>
                                        <th class="text-muted fw-normal small">{{ __('app.etudiant') }}</th>
                                        <th class="text-muted fw-normal small text-center">{{ __('app.note') }}</th>
                                        <th class="text-muted fw-normal small text-center">{{ __('app.appreciation') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluation->notes->sortBy('etudiant.nom') as $note)
                                        <tr>
                                            <td class="align-middle">
                                                <span class="text-muted small">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="fw-semibold">
                                                    {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $percentage = ($note->note / $evaluation->note_max) * 100;
                                                    if ($percentage >= 80) {
                                                        $badgeColor = 'success';
                                                    } elseif ($percentage >= 60) {
                                                        $badgeColor = 'primary';
                                                    } elseif ($percentage >= 50) {
                                                        $badgeColor = 'warning';
                                                    } else {
                                                        $badgeColor = 'danger';
                                                    }
                                                @endphp
                                                <span class="badge bg-{{ $badgeColor }} bg-opacity-10 text-{{ $badgeColor }} px-3">
                                                    {{ number_format($note->note, 2) }} / {{ $evaluation->note_max }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($percentage >= 80)
                                                    <span class="badge bg-success">{{ __('app.excellent') }}</span>
                                                @elseif($percentage >= 60)
                                                    <span class="badge bg-primary">{{ __('app.bien') }}</span>
                                                @elseif($percentage >= 50)
                                                    <span class="badge bg-warning text-dark">{{ __('app.passable') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('app.insuffisant') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-clipboard-list text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">{{ __('app.aucune_note') }}</h5>
                            <p class="text-muted small">{{ __('app.aucune_note_enregistree') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">{{ __('app.confirmer_suppression_evaluation') }}</p>
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ __('app.action_irreversible') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('app.annuler') }}
                </button>
                <form method="POST" action="{{ route('evaluations.destroy', $evaluation->id_evaluation) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        {{ __('app.supprimer_definitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
