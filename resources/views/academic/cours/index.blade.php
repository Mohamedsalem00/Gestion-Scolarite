@extends('layouts.dashboard')

@section('title', __('app.cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.cours') }}</li>
@endsection

@section('header-actions')
    @can('create', App\Models\Cours::class)
        <a href="{{ route('cours.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            {{ __('app.ajouter_cours') }}
        </a>
    @endcan
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="Total Cours" 
                :value="$cours->count()" 
                icon="bi-book"
                color="primary" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="Matières" 
                :value="$cours->pluck('matiere')->unique()->count()" 
                icon="bi-journal-text"
                color="success" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="Aujourd'hui" 
                :value="$cours->where('jour', strtolower(now()->locale('fr_FR')->dayName))->count()" 
                icon="bi-calendar-day"
                color="info" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="Enseignants actifs" 
                :value="$cours->pluck('id_enseignant')->unique()->count()" 
                icon="bi-person-badge"
                color="warning" />
        </div>
    </div>

    <!-- Actions Menu -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-plus-circle text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5 class="card-title">{{ __('Nouveau Cours') }}</h5>
                    <p class="card-text">Programmer un nouveau cours dans l'emploi du temps</p>
                    @can('create', App\Models\Cours::class)
                    <a href="{{ route('cour.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus me-1"></i>
                        {{ __('Ajouter un cours') }}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-week text-info mb-3" style="font-size: 3rem;"></i>
                    <h5 class="card-title">{{ __('Emploi du Temps') }}</h5>
                    <p class="card-text">Consulter l'emploi du temps complet par classe</p>
                    <a href="{{ route('cours.spectacle') }}" class="btn btn-info">
                        <i class="bi bi-eye me-1"></i>
                        {{ __('Voir l\'emploi du temps') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Data Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-list-ul me-2"></i>
                {{ __('Liste des Cours') }}
            </h5>
            <!-- Filter by Day -->
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="dayFilter" style="width: auto;">
                    <option value="">{{ __('Tous les jours') }}</option>
                    <option value="lundi">{{ __('Lundi') }}</option>
                    <option value="mardi">{{ __('Mardi') }}</option>
                    <option value="mercredi">{{ __('Mercredi') }}</option>
                    <option value="jeudi">{{ __('Jeudi') }}</option>
                    <option value="vendredi">{{ __('Vendredi') }}</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <x-table.data-table 
                :columns="[
                    ['key' => 'id_cours', 'label' => 'ID', 'sortable' => true],
                    ['key' => 'matiere', 'label' => 'Matière', 'sortable' => true],
                    ['key' => 'jour', 'label' => 'Jour', 'sortable' => true],
                    ['key' => 'horaire', 'label' => 'Horaire'],
                    ['key' => 'enseignant', 'label' => 'Enseignant'],
                    ['key' => 'classe', 'label' => 'Classe'],
                    ['key' => 'actions', 'label' => 'Actions', 'width' => '150px']
                ]"
                :data="$cours"
                searchable="true"
                empty-message="Aucun cours trouvé">
                
                @foreach($cours as $course)
                <tr>
                    <td>{{ $course->id_cours }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $course->matiere }}</span>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ ucfirst($course->jour) }}</span>
                    </td>
                    <td>
                        <small>{{ $course->date_debut }} - {{ $course->date_fin }}</small>
                    </td>
                    <td>
                        @if($course->enseignant)
                            <span class="text-dark">{{ $course->enseignant->prenom }} {{ $course->enseignant->nom }}</span>
                        @else
                            <span class="text-muted">Non assigné</span>
                        @endif
                    </td>
                    <td>
                        @if($course->classe)
                            <span class="badge bg-info">{{ $course->classe->nom_classe }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        @include('academic.cours.partials.actions', ['course' => $course])
                    </td>
                </tr>
                @endforeach
            </x-table.data-table>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Simple day filter functionality
document.getElementById('dayFilter').addEventListener('change', function() {
    const selectedDay = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        if (selectedDay === '') {
            row.style.display = '';
        } else {
            const dayCell = row.cells[2].textContent.toLowerCase();
            row.style.display = dayCell.includes(selectedDay) ? '' : 'none';
        }
    });
});
</script>
@endpush
@endsection
