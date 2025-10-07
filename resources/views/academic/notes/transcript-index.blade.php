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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">{{ __('Relevés de notes') }}</h4>
            <p class="text-muted mb-0">{{ __('Sélectionnez un étudiant pour consulter son relevé de notes') }}</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('rapports.notes.transcript-index') }}" class="row g-3">
                <div class="col-md-4">
                    <x-form.input 
                        name="search" 
                        label="Rechercher un étudiant" 
                        :value="request('search')" 
                        placeholder="Nom, prénom ou numéro étudiant..." />
                </div>
                <div class="col-md-4">
                    <x-form.select 
                        name="classe" 
                        label="Classe" 
                        :value="request('classe')">
                        <option value="">{{ __('Toutes les classes') }}</option>
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->id_classe }}">
                                {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i>
                        {{ __('Filtrer') }}
                    </button>
                    @if(request()->hasAny(['search', 'classe']))
                        <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>
                            {{ __('Réinitialiser') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Students List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-people me-2"></i>
                {{ __('Liste des étudiants') }}
                <span class="badge bg-primary ms-2">{{ $etudiants->total() }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if($etudiants->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Étudiant') }}</th>
                                <th>{{ __('Numéro') }}</th>
                                <th>{{ __('Classe') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                                <i class="bi bi-person text-white"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $etudiant->nom }} {{ $etudiant->prenom }}</div>
                                                <small class="text-muted">{{ $etudiant->email ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $etudiant->numero_etudiant }}</span>
                                    </td>
                                    <td>
                                        @if($etudiant->classe)
                                            <span class="badge bg-info">
                                                {{ $etudiant->classe->nom_classe }} - {{ $etudiant->classe->niveau }}
                                            </span>
                                        @else
                                            <span class="text-muted">{{ __('Aucune classe') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- Full transcript -->
                                            <a href="{{ route('rapports.notes.transcript', $etudiant) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="{{ __('Relevé complet') }}">
                                                <i class="bi bi-file-earmark-text me-1"></i>
                                                {{ __('Relevé complet') }}
                                            </a>
                                            
                                            <!-- Trimestre dropdowns -->
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                        data-bs-toggle="dropdown">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ __('Par trimestre') }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" 
                                                           href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 1]) }}">
                                                            <i class="bi bi-1-circle me-2"></i>
                                                            {{ __('1er Trimestre') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" 
                                                           href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 2]) }}">
                                                            <i class="bi bi-2-circle me-2"></i>
                                                            {{ __('2ème Trimestre') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" 
                                                           href="{{ route('rapports.notes.transcript', [$etudiant, 'trimestre' => 3]) }}">
                                                            <i class="bi bi-3-circle me-2"></i>
                                                            {{ __('3ème Trimestre') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $etudiants->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-people display-1 text-muted"></i>
                    <h5 class="mt-3">{{ __('Aucun étudiant trouvé') }}</h5>
                    <p class="text-muted">{{ __('Essayez de modifier vos critères de recherche.') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
}
</style>
@endsection