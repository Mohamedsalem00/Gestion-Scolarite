@extends('layouts.dashboard')

@section('title', __('Relevé de notes') . ' - ' . $etudiant->nom . ' ' . $etudiant->prenom)

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('rapports.notes.transcript-index') }}">{{ __('Relevés de notes') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ $etudiant->nom }} {{ $etudiant->prenom }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h4 class="mb-0">{{ __('Relevé de notes') }}</h4>
            @if($trimestre)
                <p class="text-muted mb-0">{{ __('Trimestre') }} {{ $trimestre }}</p>
            @endif
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Retour à la liste') }}
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer me-1"></i>
                {{ __('Imprimer') }}
            </button>
        </div>
    </div>

    <!-- Transcript Card -->
    <div class="card print-card">
        <div class="card-body">
            <!-- Header for Print -->
            <div class="print-header text-center mb-4">
                <h2 class="mb-1">{{ __('RELEVÉ DE NOTES') }}</h2>
                @if($trimestre)
                    <h4 class="text-muted">{{ __('Trimestre') }} {{ $trimestre }} - {{ __('Année scolaire') }} {{ date('Y') }}/{{ date('Y') + 1 }}</h4>
                @else
                    <h4 class="text-muted">{{ __('Année scolaire') }} {{ date('Y') }}/{{ date('Y') + 1 }}</h4>
                @endif
                <hr>
            </div>

            <!-- Student Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>{{ __('Informations de l\'étudiant') }}</h5>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="fw-bold">{{ __('Nom complet') }}:</td>
                            <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">{{ __('Numéro étudiant') }}:</td>
                            <td>{{ $etudiant->numero_etudiant }}</td>
                        </tr>
                        @if($etudiant->classe)
                        <tr>
                            <td class="fw-bold">{{ __('Classe') }}:</td>
                            <td>{{ $etudiant->classe->nom_classe }} - {{ __('Niveau') }} {{ $etudiant->classe->niveau }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="fw-bold">{{ __('Date de naissance') }}:</td>
                            <td>{{ $etudiant->date_naissance ? $etudiant->date_naissance->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>{{ __('Résumé académique') }}</h5>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value text-primary">{{ number_format($overallAverage, 2) }}/20</div>
                            <div class="stat-label">{{ __('Moyenne générale') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-info">{{ $notes->count() }}</div>
                            <div class="stat-label">{{ __('Total évaluations') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-success">{{ count($notesByMatiere) }}</div>
                            <div class="stat-label">{{ __('Matières') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grades by Subject -->
            @if($notesByMatiere->count() > 0)
                <h5 class="mb-3">{{ __('Notes par matière') }}</h5>
                
                @foreach($notesByMatiere as $matiere => $matiereNotes)
                    <div class="matiere-section mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 text-primary">
                                <i class="bi bi-book me-1"></i>
                                {{ $matiere }}
                            </h6>
                            <span class="badge bg-primary fs-6">
                                {{ __('Moyenne') }}: {{ number_format($averages[$matiere], 2) }}/20
                            </span>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Type d\'évaluation') }}</th>
                                        <th>{{ __('Note obtenue') }}</th>
                                        <th>{{ __('Note maximale') }}</th>
                                        <th>{{ __('Note sur 20') }}</th>
                                        <th>{{ __('Appréciation') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matiereNotes as $note)
                                        <tr>
                                            <td>{{ $note->evaluation?->date?->format('d/m/Y') ?? 'N/A' }}</td>
                                            <td>
                                                @if($note->evaluation)
                                                    <span class="badge bg-secondary">{{ ucfirst($note->evaluation->type) }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-center fw-bold">{{ $note->note }}</td>
                                            <td class="text-center">{{ $note->evaluation?->note_max ?? 20 }}</td>
                                            <td class="text-center">
                                                @php
                                                    $noteMax = $note->evaluation?->note_max ?? 20;
                                                    $noteSur20 = ($note->note / $noteMax) * 20;
                                                @endphp
                                                <span class="badge {{ $noteSur20 >= 10 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ number_format($noteSur20, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $appreciation = '';
                                                    if($noteSur20 >= 18) $appreciation = 'Excellent';
                                                    elseif($noteSur20 >= 16) $appreciation = 'Très bien';
                                                    elseif($noteSur20 >= 14) $appreciation = 'Bien';
                                                    elseif($noteSur20 >= 12) $appreciation = 'Assez bien';
                                                    elseif($noteSur20 >= 10) $appreciation = 'Passable';
                                                    else $appreciation = 'Insuffisant';
                                                @endphp
                                                <small class="text-muted">{{ $appreciation }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <!-- Overall Statistics -->
                <div class="mt-4 p-3 bg-light rounded">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="fw-bold text-primary">{{ number_format($overallAverage, 2) }}/20</div>
                            <small class="text-muted">{{ __('Moyenne générale') }}</small>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-success">{{ $notes->where(function($n) { return (($n->note / ($n->evaluation?->note_max ?? 20)) * 20) >= 10; })->count() }}</div>
                            <small class="text-muted">{{ __('Notes ≥ 10/20') }}</small>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-info">{{ $notes->count() }}</div>
                            <small class="text-muted">{{ __('Total évaluations') }}</small>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-data display-1 text-muted"></i>
                    <h5 class="mt-3">{{ __('Aucune note disponible') }}</h5>
                    <p class="text-muted">
                        @if($trimestre)
                            {{ __('Aucune note n\'a été trouvée pour ce trimestre.') }}
                        @else
                            {{ __('Cet étudiant n\'a pas encore de notes enregistrées.') }}
                        @endif
                    </p>
                </div>
            @endif

            <!-- Footer for Print -->
            <div class="print-footer mt-5 pt-3 border-top text-center">
                <small class="text-muted">
                    {{ __('Document généré le') }} {{ now()->format('d/m/Y à H:i') }} - 
                    {{ __('Système de Gestion Scolaire') }}
                </small>
            </div>
        </div>
    </div>
</div>

<style>
/* Print Styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    .print-card {
        box-shadow: none !important;
        border: none !important;
        margin: 0 !important;
    }
    
    .print-header {
        margin-bottom: 20px !important;
    }
    
    .table {
        font-size: 12px;
    }
    
    .matiere-section {
        page-break-inside: avoid;
        margin-bottom: 25px !important;
    }
    
    body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .badge {
        border: 1px solid #000 !important;
        color: #000 !important;
        background-color: transparent !important;
    }
}

/* Screen Styles */
.stats-grid {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1.2;
}

.stat-label {
    font-size: 0.875rem;
    color: #6c757d;
}

.matiere-section {
    border-left: 3px solid var(--bs-primary);
    padding-left: 15px;
}

@media (max-width: 768px) {
    .stats-grid {
        flex-direction: column;
        gap: 10px;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endsection