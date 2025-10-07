@extends('layouts.dashboard')

@section('title', __('app.evaluations'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.evaluations') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('evaluations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            {{ __('app.nouvelle_evaluation') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Overview -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">{{ __('app.total_evaluations') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $evaluations->count() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-clipboard-check text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">{{ __('app.examens') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $evaluations->where('type', 'examen')->count() }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-file-alt text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">{{ __('app.controles') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $evaluations->where('type', 'controle')->count() }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-edit text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">{{ __('app.devoirs') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $evaluations->where('type', 'devoir')->count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-tasks text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluations Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Header -->
            <div class="mb-4">
                <h5 class="mb-1 fw-bold">{{ __('app.liste_evaluations') }}</h5>
                <p class="text-muted small mb-0">{{ __('app.gestion_academique') }}</p>
            </div>

            <!-- Filters -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">{{ __('app.rechercher') }}</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
                </div>
                <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">{{ __('app.type') }}</label>
                    <select class="form-select" id="typeFilter">
                        <option value="">{{ __('app.tous_les_types') }}</option>
                        <option value="examen">{{ __('app.examens') }}</option>
                        <option value="controle">{{ __('app.controles') }}</option>
                        <option value="devoir">{{ __('app.devoirs') }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">{{ __('app.classe') }}</label>
                    <select class="form-select" id="classeFilter">
                        <option value="">{{ __('app.toutes_les_classes') }}</option>
                        @foreach($evaluations->pluck('classe')->unique()->filter() as $classe)
                            <option value="{{ $classe->nom_classe }}">{{ $classe->nom_classe }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($evaluations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="evaluationsTable">
                        <thead>
                            <tr class="border-bottom">
                                <th class="text-muted fw-normal small" style="width: 50px;">#</th>
                                <th class="text-muted fw-normal small">{{ __('app.matiere') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.type') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.date') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.horaire') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.classe') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluations as $evaluation)
                            <tr>
                                <td class="align-middle">
                                    <span class="text-muted small">{{ $evaluation->id_evaluation }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded px-2 py-1 me-2">
                                            <i class="fas fa-book text-primary small"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $evaluation->matiere_name }}</span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    @if($evaluation->type == 'examen')
                                        <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger">
                                            <i class="fas fa-file-alt me-1"></i>{{ ucfirst($evaluation->type) }}
                                        </span>
                                    @elseif($evaluation->type == 'controle')
                                        <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning">
                                            <i class="fas fa-edit me-1"></i>{{ ucfirst($evaluation->type) }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success">
                                            <i class="fas fa-tasks me-1"></i>{{ ucfirst($evaluation->type) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    @php
                                        $startTime = $evaluation->date_debut ? \Carbon\Carbon::parse($evaluation->date_debut)->format('H:i') : null;
                                        $endTime = $evaluation->date_fin ? \Carbon\Carbon::parse($evaluation->date_fin)->format('H:i') : null;
                                        $hasValidStart = $startTime && $startTime != '00:00';
                                        $hasValidEnd = $endTime && $endTime != '00:00';
                                    @endphp
                                    
                                    @if($hasValidStart || $hasValidEnd)
                                        <div class="d-flex flex-column align-items-center">
                                            @if($hasValidStart)
                                                <span class="badge bg-success bg-opacity-10 text-success border-0 mb-1">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $startTime }}
                                                </span>
                                            @endif
                                            @if($hasValidEnd)
                                                <span class="badge bg-danger bg-opacity-10 text-danger border-0">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $endTime }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @if($evaluation->classe)
                                        <span class="badge rounded-pill bg-light text-dark border">{{ $evaluation->classe->nom_classe }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @include('academic.evaluations.partials.actions', ['evaluation' => $evaluation])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- No Results Message (hidden by default) -->
                <div id="noResultsMessage" class="text-center py-5" style="display: none;">
                    <div class="mb-3">
                        <i class="fas fa-search text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2">{{ __('app.aucun_resultat') }}</h5>
                    <p class="text-muted small">{{ __('app.essayez_autres_filtres') }}</p>
                    <button class="btn btn-sm btn-outline-primary" onclick="resetFilters()">
                        <i class="fas fa-redo me-1"></i>
                        {{ __('app.reinitialiser_filtres') }}
                    </button>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-clipboard-list text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2">{{ __('app.aucune_evaluation_trouvee') }}</h5>
                    <p class="text-muted mb-4 small">{{ __('app.no_data') }}</p>
                    @admin
                        <a href="{{ route('evaluations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-1"></i>
                            {{ __('app.nouvelle_evaluation') }}
                        </a>
                    @endadmin
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// Filter functionality
const searchInput = document.getElementById('searchInput');
const typeFilter = document.getElementById('typeFilter');
const classeFilter = document.getElementById('classeFilter');
const noResultsMessage = document.getElementById('noResultsMessage');
const tableContainer = document.querySelector('.table-responsive');

function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedType = typeFilter.value.toLowerCase();
    const selectedClasse = classeFilter.value.toLowerCase();
    
    const rows = document.querySelectorAll('#evaluationsTable tbody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const matiere = row.cells[1].textContent.toLowerCase();
        const type = row.cells[2].textContent.toLowerCase();
        const date = row.cells[3].textContent.toLowerCase();
        const classe = row.cells[5].textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
        const matchesType = selectedType === '' || type.includes(selectedType);
        const matchesClasse = selectedClasse === '' || classe.includes(selectedClasse);
        
        if (matchesSearch && matchesType && matchesClasse) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    if (visibleCount === 0) {
        tableContainer.style.display = 'none';
        noResultsMessage.style.display = 'block';
    } else {
        tableContainer.style.display = 'block';
        noResultsMessage.style.display = 'none';
    }
}

// Reset all filters
function resetFilters() {
    searchInput.value = '';
    typeFilter.value = '';
    classeFilter.value = '';
    filterTable();
}

// Add event listeners
searchInput.addEventListener('keyup', filterTable);
typeFilter.addEventListener('change', filterTable);
classeFilter.addEventListener('change', filterTable);
</script>
@endpush
@endsection
