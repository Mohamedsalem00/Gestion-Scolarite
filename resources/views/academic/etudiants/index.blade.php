@extends('layouts.dashboard')

@section('title', __('app.etudiants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.etudiants') }}</li>
@endsection

@section('header-actions')
    @can('see', App\Models\Etudiant::class)
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            {{ __('app.add_student') }}
        </a>
    @endcan
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-cards.info-card
                title="{{__('app.total_etudiants') }}"
                :value="$etudiants->count()"
                icon="fas fa-user-graduate"
                color="primary"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="{{__('app.etudiants_hommes') }}"
                :value="$etudiants->where('genre', 'masculin')->count()"
                icon="fas fa-mars"
                color="info"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="{{__('app.etudiantes_femmes') }}"
                :value="$etudiants->where('genre', 'feminin')->count()"
                icon="fas fa-venus"
                color="warning"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="{{__('app.classes_actives') }}"
                :value="$etudiants->pluck('classe')->unique()->count()"
                icon="fas fa-school"
                color="success"
            />
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                {{ __('app.liste_etudiants') }}
            </h5>
        </div>
        <div class="card-body">
            @if($etudiants->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('app.nom_complet') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.telephone') }}</th>
                                <th>{{ __('app.classe') }}</th>
                                <th>{{ __('app.genre') }}</th>
                                <th>{{ __('app.actions') }}</th>
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
                                    <td>
                                        <a href="{{ route('etudiants.show', $etudiant->id_etudiant) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('etudiants.edit', $etudiant->id_etudiant) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-user-graduate text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">{{ __('app.aucun_etudiant_trouve') }}</p>
                    @can('create', App\Models\Etudiant::class)
                        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>
                            {{ __('app.ajouter_etudiant') }}
                        </a>
                    @endcan
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
