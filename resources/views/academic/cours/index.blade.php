@extends('layouts.dashboard')

@section('title', __('app.cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.cours') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('cours.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_cours') }}
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
                            <p class="text-muted mb-1 small">{{ __('app.total_cours') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $cours->count() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-book-open text-primary" style="font-size: 1.5rem;"></i>
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
                            <p class="text-muted mb-1 small">{{ __('app.matieres') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $cours->pluck('matiere')->unique()->count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-book text-success" style="font-size: 1.5rem;"></i>
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
                            <p class="text-muted mb-1 small">{{ __('app.aujourdhui') }}</p>
                            <h3 class="mb-0 fw-bold">{{ $cours->where('jour', strtolower(now()->locale('fr_FR')->dayName))->count() }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar-day text-info" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 small opacity-75">{{ __('app.emploi_du_temps') }}</p>
                            <h6 class="mb-0">{{ __('app.voir_emploi_temps') }}</h6>
                        </div>
                        <a href="{{ route('cours.spectacle') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Header -->
            <div class="mb-4">
                <h5 class="mb-1 fw-bold">{{ __('app.liste_cours') }}</h5>
                <p class="text-muted small mb-0">{{ __('app.gestion_academique') }}</p>
            </div>

            <!-- Filters -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">{{ __('app.rechercher') }}</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">{{ __('app.jour') }}</label>
                    <select class="form-select" id="dayFilter">
                        <option value="">{{ __('app.tous_les_jours') }}</option>
                        <option value="lundi">{{ __('app.lundi') }}</option>
                        <option value="mardi">{{ __('app.mardi') }}</option>
                        <option value="mercredi">{{ __('app.mercredi') }}</option>
                        <option value="jeudi">{{ __('app.jeudi') }}</option>
                        <option value="vendredi">{{ __('app.vendredi') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">{{ __('app.classe') }}</label>
                    <select class="form-select" id="classeFilter">
                        <option value="">{{ __('app.toutes_les_classes') }}</option>
                        @foreach($cours->pluck('classe')->unique()->filter() as $classe)
                            <option value="{{ $classe->nom_classe }}">{{ $classe->nom_classe }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">{{ __('app.matiere') }}</label>
                    <select class="form-select" id="matiereFilter">
                        <option value="">{{ __('app.toutes_les_matieres') }}</option>
                        @foreach($cours->pluck('matiere')->unique() as $matiere)
                            <option value="{{ $matiere->code_matiere }}">{{ $matiere->code_matiere }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">{{ __('app.enseignant') }}</label>
                    <select class="form-select" id="enseignantFilter">
                        <option value="">{{ __('app.tous_les_enseignants') }}</option>
                        @foreach($cours->pluck('enseignant')->unique()->filter() as $enseignant)
                            <option value="{{ $enseignant->prenom }} {{ $enseignant->nom }}">
                                {{ $enseignant->prenom }} {{ $enseignant->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($cours->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="border-bottom">
                                <th class="text-muted fw-normal small" style="width: 50px;">#</th>
                                <th class="text-muted fw-normal small">{{ __('app.matiere') }}</th>
                                <th class="text-muted fw-normal small">{{ __('app.classe') }}</th>
                                <th class="text-muted fw-normal small">{{ __('app.enseignant') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.jour') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.horaire') }}</th>
                                <th class="text-muted fw-normal small text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="coursTableBody">
                            @foreach($cours as $course)
                            <tr>
                                <td class="align-middle">
                                    <span class="text-muted small">{{ $course->id_cours }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded px-2 py-1 me-2">
                                            <span class="text-primary small fw-medium">{{ $course->matiere->code_matiere }}</span>
                                        </div>
                                        <span>{{ $course->matiere->nom_matiere ?? $course->matiere->code_matiere }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($course->classe)
                                        <span class="badge rounded-pill bg-light text-dark border">{{ $course->classe->nom_classe }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($course->enseignant)
                                        <span>{{ $course->enseignant->prenom }} {{ $course->enseignant->nom }}</span>
                                    @else
                                        <span class="text-muted fst-italic small">{{ __('app.non_assigne') }}</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary">{{ ucfirst($course->jour) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success border-0 mb-1">
                                            {{ \Carbon\Carbon::parse($course->date_debut)->format('H:i') }}
                                        </span>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border-0">
                                            {{ \Carbon\Carbon::parse($course->date_fin)->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    @include('academic.cours.partials.actions', ['course' => $course])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- No Results Message (hidden by default) -->
                <div id="noResultsMessage" class="text-center py-5" style="display: none;">
                    <div class="mb-3">
                        <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2">{{ __('app.aucun_resultat') }}</h5>
                    <p class="text-muted small">{{ __('app.essayez_autres_filtres') }}</p>
                    <button class="btn btn-sm btn-outline-primary" onclick="resetFilters()">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        {{ __('app.reinitialiser_filtres') }}
                    </button>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2">{{ __('app.aucun_cours_trouve') }}</h5>
                    <p class="text-muted mb-4 small">{{ __('app.no_data') }}</p>
                    @admin
                        <a href="{{ route('cours.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>
                            {{ __('app.ajouter_cours') }}
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
const dayFilter = document.getElementById('dayFilter');
const classeFilter = document.getElementById('classeFilter');
const matiereFilter = document.getElementById('matiereFilter');
const enseignantFilter = document.getElementById('enseignantFilter');
const noResultsMessage = document.getElementById('noResultsMessage');
const tableContainer = document.querySelector('.table-responsive');

function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedDay = dayFilter.value.toLowerCase();
    const selectedClasse = classeFilter.value.toLowerCase();
    const selectedMatiere = matiereFilter.value.toLowerCase();
    const selectedEnseignant = enseignantFilter.value.toLowerCase();
    
    const rows = document.querySelectorAll('#coursTableBody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const matiere = row.cells[1].textContent.toLowerCase();
        const classe = row.cells[2].textContent.toLowerCase();
        const enseignant = row.cells[3].textContent.toLowerCase();
        const jour = row.cells[4].textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
        const matchesDay = selectedDay === '' || jour.includes(selectedDay);
        const matchesClasse = selectedClasse === '' || classe.includes(selectedClasse);
        const matchesMatiere = selectedMatiere === '' || matiere.includes(selectedMatiere);
        const matchesEnseignant = selectedEnseignant === '' || enseignant.includes(selectedEnseignant);
        
        if (matchesSearch && matchesDay && matchesClasse && matchesMatiere && matchesEnseignant) {
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
    dayFilter.value = '';
    classeFilter.value = '';
    matiereFilter.value = '';
    enseignantFilter.value = '';
    filterTable();
}

// Add event listeners
searchInput.addEventListener('keyup', filterTable);
dayFilter.addEventListener('change', filterTable);
classeFilter.addEventListener('change', filterTable);
matiereFilter.addEventListener('change', filterTable);
enseignantFilter.addEventListener('change', filterTable);
</script>
@endpush
@endsection
