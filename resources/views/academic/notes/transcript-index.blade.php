@extends('layouts.dashboard')

@section('title', __('Relevés de notes'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Relevés de notes') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="mb-2">Relevés de notes</h2>
        <p class="text-muted">Recherchez un étudiant pour consulter son relevé</p>
    </div>

    <!-- Search First Interface -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="search-box bg-white rounded-3 shadow-sm p-4">
                <form method="GET" action="{{ route('rapports.notes.transcript-index') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" 
                               name="search" 
                               class="form-control form-control-lg" 
                               value="{{ request('search') }}" 
                               placeholder="Nom, prénom ou matricule de l'étudiant..."
                               autocomplete="off"
                               id="studentSearch">
                    </div>
                    <div class="col-md-4">
                        <select name="classe" class="form-select form-select-lg">
                            <option value="">Toutes les classes</option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id_classe }}" {{ request('classe') == $classe->id_classe ? 'selected' : '' }}>
                                    {{ $classe->nom_classe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-search me-1"></i>
                            Rechercher
                        </button>
                    </div>
                </form>
                
                @if(request()->hasAny(['search', 'classe']))
                    <div class="text-center mt-3">
                        <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-outline-secondary">
                            Effacer les filtres
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Results -->
    @if(request()->filled('search') || request()->filled('classe'))
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if($etudiants->count() > 0)
                    <div class="mb-3">
                        <small class="text-muted">{{ $etudiants->total() }} résultat(s) trouvé(s)</small>
                    </div>
                    
                    <!-- Student Cards -->
                    <div class="row g-3">
                        @foreach($etudiants as $etudiant)
                            <div class="col-md-6 col-lg-4">
                                <div class="card student-card h-100">
                                    <div class="card-body">
                                        <a href="{{ route('etudiants.show', $etudiant->matricule) }}" class="text-decoration-none">
                                            <h6 class="card-title mb-1">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h6>
                                        </a>
                                        <p class="card-text text-muted small mb-2">
                                            {{ $etudiant->matricule }} 
                                            @if($etudiant->classe)
                                                • {{ $etudiant->classe->nom_classe }}
                                            @endif
                                        </p>
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('rapports.notes.transcript', $etudiant) }}" 
                                               class="btn btn-primary btn-sm">
                                                Relevé complet
                                            </a>
                                            <div class="btn-group w-100">
                                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle w-100" 
                                                        data-bs-toggle="dropdown">
                                                    Par trimestre
                                                </button>
                                                <ul class="dropdown-menu w-100">
                                                    <li><a class="dropdown-item" href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 1]) }}">1er Trimestre</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 2]) }}">2ème Trimestre</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 3]) }}">3ème Trimestre</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($etudiants->hasPages())
                        <div class="text-center mt-4">
                            {{ $etudiants->withQueryString()->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-search fs-1 text-muted"></i>
                        </div>
                        <h5>Aucun résultat</h5>
                        <p class="text-muted">Aucun étudiant ne correspond à votre recherche</p>
                        <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-outline-primary">
                            Nouvelle recherche
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Welcome State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-file-text fs-1 text-primary"></i>
            </div>
            <h4 class="mb-3">Recherchez un étudiant</h4>
            <p class="text-muted mb-4">
                Utilisez la barre de recherche ci-dessus pour trouver un étudiant<br>
                et consulter son relevé de notes
            </p>
            
            <!-- Quick Access by Class -->
            @if($classes->count() > 0)
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h6 class="mb-3">Accès rapide par classe</h6>
                        <div class="row g-2">
                            @foreach($classes->take(6) as $classe)
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('rapports.notes.transcript-index', ['classe' => $classe->id_classe]) }}" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        {{ $classe->nom_classe }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @if($classes->count() > 6)
                            <p class="mt-2 mb-0">
                                <small class="text-muted">+ {{ $classes->count() - 6 }} autres classes</small>
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>

<style>
.search-box {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.search-box:focus-within {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.student-card {
    border: 1px solid #e9ecef;
    transition: all 0.2s ease;
    cursor: pointer;
}

.student-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-color: #007bff;
}

.form-control-lg, .form-select-lg {
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.form-control-lg:focus, .form-select-lg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn {
    border-radius: 6px;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .search-box {
        margin: 0 15px;
    }
    
    .search-box .row > div {
        margin-bottom: 10px;
    }
    
    .search-box .col-md-2 {
        margin-bottom: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('studentSearch');
    const form = searchInput.closest('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Submit form on Enter key
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();
        }
    });
    
    // Auto-submit when class is selected
    const classeSelect = form.querySelector('select[name="classe"]');
    classeSelect.addEventListener('change', function() {
        form.submit();
    });
    
    // Focus search on page load if no results
    @if(!request()->hasAny(['search', 'classe']))
        searchInput.focus();
    @endif
    
    // Keyboard shortcut: Ctrl/Cmd + K to focus search
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.focus();
        }
    });
    
    // Add loading state to search button
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Recherche...';
        
        // Re-enable after 3 seconds as fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-search me-1"></i> Rechercher';
        }, 3000);
    });
});
</script>
@endsection