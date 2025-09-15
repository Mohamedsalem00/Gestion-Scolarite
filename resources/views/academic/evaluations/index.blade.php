@extends('layouts.dashboard')

@section('title', __('app.evaluations'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Évaluations') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-cards.info-card
                title="Total Évaluations"
                :value="$evaluations->count()"
                icon="bi bi-clipboard-check"
                color="primary" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Examens"
                :value="$evaluations->where('type', 'examen')->count()"
                icon="bi bi-journal-text"
                color="danger" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Contrôles"
                :value="$evaluations->where('type', 'controle')->count()"
                icon="bi bi-pencil-square"
                color="warning" />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Devoirs"
                :value="$evaluations->where('type', 'devoir')->count()"
                icon="bi bi-book"
                color="success" />
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-check me-2"></i>
                        {{ __('Gestion des Évaluations') }}
                    </h5>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group" role="group">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Rechercher..." style="max-width: 200px;">
                        <select id="typeFilter" class="form-select me-2" style="max-width: 150px;">
                            <option value="">Tous les types</option>
                            <option value="examen">Examens</option>
                            <option value="controle">Contrôles</option>
                            <option value="devoir">Devoirs</option>
                        </select>
                        <a href="{{ route('evaluations.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-lg me-1"></i>
                            {{ __('Nouvelle Évaluation') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluations Table -->
    <div class="card">
        <div class="card-body">
            <x-table.data-table 
                id="evaluationsTable"
                :columns="[
                    ['key' => 'id_evaluation', 'label' => 'ID'],
                    ['key' => 'matiere', 'label' => 'Matière'],
                    ['key' => 'type', 'label' => 'Type'],
                    ['key' => 'date', 'label' => 'Date'],
                    ['key' => 'date_debut', 'label' => 'Heure début'],
                    ['key' => 'date_fin', 'label' => 'Heure fin'],
                    ['key' => 'classe', 'label' => 'Classe'],
                    ['key' => 'actions', 'label' => 'Actions']
                ]">
                @foreach ($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->id_evaluation }}</td>
                    <td>
                        <span class="fw-semibold">{{ $evaluation->matiere }}</span>
                    </td>
                    <td>
                        @if($evaluation->type == 'examen')
                            <span class="badge bg-danger">{{ ucfirst($evaluation->type) }}</span>
                        @elseif($evaluation->type == 'controle')
                            <span class="badge bg-warning">{{ ucfirst($evaluation->type) }}</span>
                        @else
                            <span class="badge bg-success">{{ ucfirst($evaluation->type) }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}</td>
                    <td>{{ $evaluation->date_debut ? \Carbon\Carbon::parse($evaluation->date_debut)->format('H:i') : '-' }}</td>
                    <td>{{ $evaluation->date_fin ? \Carbon\Carbon::parse($evaluation->date_fin)->format('H:i') : '-' }}</td>
                    <td>
                        @if($evaluation->classe)
                            <span class="badge bg-info">{{ $evaluation->classe->nom_classe }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @include('academic.evaluations.partials.actions', ['evaluation' => $evaluation])
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
    const typeFilter = document.getElementById('typeFilter');
    const table = document.getElementById('evaluationsTable');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value.toLowerCase();

        rows.forEach(row => {
            const matiere = row.cells[1].textContent.toLowerCase();
            const type = row.cells[2].textContent.toLowerCase();
            const date = row.cells[3].textContent.toLowerCase();
            
            const matchesSearch = matiere.includes(searchTerm) || 
                                type.includes(searchTerm) || 
                                date.includes(searchTerm);
            
            const matchesType = selectedType === '' || type.includes(selectedType);
            
            row.style.display = matchesSearch && matchesType ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    typeFilter.addEventListener('change', filterTable);
});
</script>
@endsection
