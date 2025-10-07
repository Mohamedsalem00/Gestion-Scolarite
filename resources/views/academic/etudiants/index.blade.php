@extends('layouts.dashboard')

@section('title', __('app.etudiants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.etudiants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
            {{ __('app.add_student') }}
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.total_etudiants') }}</h6>
                            <h3 class="mb-0">{{ $etudiants->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-mars fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.etudiants_hommes') }}</h6>
                            <h3 class="mb-0">{{ $etudiants->where('genre', 'masculin')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-venus fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.etudiantes_femmes') }}</h6>
                            <h3 class="mb-0">{{ $etudiants->where('genre', 'feminin')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-school fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.classes_actives') }}</h6>
                            <h3 class="mb-0">{{ $etudiants->pluck('classe')->unique()->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">{{ __('app.liste_etudiants') }}</h5>
            @if($etudiants->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="border-bottom">
                                <th class="text-muted fw-normal">{{ __('app.nom_complet') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.email') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.telephone') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.classe') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.genre') }}</th>
                                <th class="text-muted fw-normal text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->email ?? 'N/A' }}</td>
                                    <td>{{ $etudiant->telephone ?? 'N/A' }}</td>
                                    <td>{{ $etudiant->classe?->nom_classe ?? 'Non assigné' }}</td>
                                    <td>{{ ucfirst($etudiant->genre ?? 'N/A') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('etudiants.show', $etudiant) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="{{ __('app.voir') }}">
                                                {{ __('app.voir') }}
                                            </a>
                                            @admin
                                                <a href="{{ route('etudiants.edit', $etudiant) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="{{ __('app.modifier') }}">
                                                    {{ __('app.modifier') }}
                                                </a>
                                                <form action="{{ route('etudiants.destroy', $etudiant) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete-student" 
                                                            title="{{ __('app.supprimer') }}"
                                                            data-student-name="{{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                                        {{ __('app.supprimer') }}
                                                    </button>
                                                </form>
                                            @endadmin
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-user-graduate fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">{{ __('app.aucun_etudiant_trouve') }}</p>
                    @admin
                        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                            {{ __('app.ajouter_etudiant') }}
                        </a>
                    @endadmin
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-student').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const studentName = this.dataset.studentName;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'étudiant "${studentName}" ?`)) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
