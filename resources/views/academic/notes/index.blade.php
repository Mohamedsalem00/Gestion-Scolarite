@extends('layouts.dashboard')

@section('title', __('app.notes_resultats'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Notes') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-cards.info-card
                title="Total Notes"
                :value="$notes->count()"
                icon="bi bi-journal-text"
                color="primary" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Moyenne Générale"
                :value="number_format($notes->avg('note'), 2)"
                icon="bi bi-bar-chart"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Notes > 10"
                :value="$notes->where('note', '>', 10)->count()"
                icon="bi bi-check-circle"
                color="info" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Notes ≤ 10"
                :value="$notes->where('note', '<=', 10)->count()"
                icon="bi bi-x-circle"
                color="warning" />
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-journal-text me-2"></i>
                        {{ __('Gestion des Notes') }}
                    </h5>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group" role="group">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher étudiant..." style="max-width: 200px;">
                        <select id="evaluationFilter" class="form-select me-2" style="max-width: 150px;">
                            <option value="">Toutes les évaluations</option>
                            @foreach ($evaluations as $eval)
                                <option value="{{ $eval->id_evaluation }}">{{ $eval->matiere }} - {{ ucfirst($eval->type) }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('notes.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-lg me-1"></i>
                            {{ __('Nouvelle Note') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Table -->
    <div class="card">
        <div class="card-body">
            <x-table.data-table 
                id="notesTable"
                :columns="[
                    ['key' => 'id_note', 'label' => 'ID'],
                    ['key' => 'etudiant', 'label' => 'Étudiant'],
                    ['key' => 'evaluation', 'label' => 'Évaluation'],
                    ['key' => 'note', 'label' => 'Note'],
                    ['key' => 'coefficient', 'label' => 'Coeff.'],
                    ['key' => 'classe', 'label' => 'Classe'],
                    ['key' => 'date', 'label' => 'Date'],
                    ['key' => 'actions', 'label' => 'Actions']
                ]">
                @foreach ($notes as $note)
                <tr data-evaluation-id="{{ $note->id_evaluation }}">
                    <td>{{ $note->id_note }}</td>
                    <td>
                        @if($note->etudiant)
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="fw-semibold">{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</div>
                                    <div class="text-muted small">{{ $note->etudiant->matricule }}</div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">Étudiant supprimé</span>
                        @endif
                    </td>
                    <td>
                        @if($note->evaluation)
                            <div>
                                <span class="fw-semibold">{{ $note->evaluation->matiere }}</span>
                                @if($note->evaluation->type == 'examen')
                                    <span class="badge bg-danger ms-1">{{ ucfirst($note->evaluation->type) }}</span>
                                @elseif($note->evaluation->type == 'controle')
                                    <span class="badge bg-warning ms-1">{{ ucfirst($note->evaluation->type) }}</span>
                                @else
                                    <span class="badge bg-success ms-1">{{ ucfirst($note->evaluation->type) }}</span>
                                @endif
                            </div>
                        @else
                            <span class="text-muted">Évaluation supprimée</span>
                        @endif
                    </td>
                    <td>
                        <span class="fw-bold {{ $note->note >= 10 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($note->note, 2) }}/20
                        </span>
                    </td>
                    <td>{{ $note->coefficient ?? 1 }}</td>
                    <td>
                        @if($note->classe)
                            <span class="badge bg-info">{{ $note->classe->nom_classe }}</span>
                        @elseif($note->etudiant && $note->etudiant->classe)
                            <span class="badge bg-info">{{ $note->etudiant->classe->nom_classe }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($note->evaluation)
                            {{ \Carbon\Carbon::parse($note->evaluation->date)->format('d/m/Y') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @include('notes.actions', ['note' => $note])
                    </td>
                </tr>
                @endforeach
            </x-table.data-table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const evaluationFilter = document.getElementById('evaluationFilter');
    const table = document.getElementById('notesTable');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedEvaluation = evaluationFilter.value;

        rows.forEach(row => {
            const student = row.cells[1].textContent.toLowerCase();
            const evaluation = row.cells[2].textContent.toLowerCase();
            const evaluationId = row.getAttribute('data-evaluation-id');
            
            const matchesSearch = student.includes(searchTerm) || evaluation.includes(searchTerm);
            const matchesEvaluation = selectedEvaluation === '' || evaluationId === selectedEvaluation;
            
            row.style.display = matchesSearch && matchesEvaluation ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    evaluationFilter.addEventListener('change', filterTable);
});
</script>
@endsection
