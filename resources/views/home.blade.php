@extends('layouts.dashboard')

@section('title', __('app.tableau_bord_admin'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('app.tableau_bord_admin') }}</li>
@endsection

@section('content')
    <!-- Dashboard Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <x-cards.info-card
                title="{{ __('app.total_etudiants') }}"
                :value="App\Models\Etudiant::count()"
                icon="fas fa-user-graduate"
                color="primary"
                :href="route('etudiants.index')"
            />
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <x-cards.info-card
                title="{{ __('app.total_enseignants') }}"
                :value="App\Models\Enseignant::count()"
                icon="fas fa-chalkboard-teacher"
                color="success"
                :href="route('enseignants.index')"
            />
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <x-cards.info-card
                title="{{ __('app.total_classes') }}"
                :value="App\Models\Classe::count()"
                icon="fas fa-school"
                color="info"
                :href="route('classes.index')"
            />
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <x-cards.info-card
                title="{{ __('app.total_cours') }}"
                :value="App\Models\Cours::count()"
                icon="fas fa-book"
                color="warning"
                :href="route('cours.index')"
            />
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.actions_rapides') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('etudiants.create') }}" class="btn btn-outline-primary w-100 py-3">
                                {{ __('app.ajouter_etudiant') }}
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('enseignants.create') }}" class="btn btn-outline-success w-100 py-3">
                                {{ __('app.ajouter_enseignant') }}
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('classes.create') }}" class="btn btn-outline-info w-100 py-3">
                                {{ __('app.ajouter_classe') }}
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('evaluations.create') }}" class="btn btn-outline-warning w-100 py-3">
                                {{ __('app.ajouter_evaluation') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Links -->
    <div class="row">
        <!-- Academic Management -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.gestion_academique') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('notes.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                {{ __('app.voir_notes') }}
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ url('/cours/spectacle') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                {{ __('app.emploi_temps') }}
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ route('evaluations.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                {{ __('app.evaluations') }}
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reports and Results -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.rapports_resultats') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ url('/note/noteDevoir1') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                Résultats Premier Trimestre - Devoirs
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ url('/note/noteExamen1') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                Résultats Premier Trimestre - Examens
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ url('/evoluation/spectacleDevoir1') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                Horaire des Devoirs
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ url('/evoluation/spectacleExamen1') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                Horaire des Examens
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Evaluations -->
    @php
        $recentEvaluations = App\Models\Evaluation::with(['classe', 'matiere'])
            ->latest()
            ->take(5)
            ->get();
    @endphp
    
    @if($recentEvaluations->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        {{ __('app.evaluations_recentes') }}
                    </h5>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-outline-primary">
                        {{ __('app.voir_tout') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ __('app.date') }}</th>
                                    <th>{{ __('app.type') }}</th>
                                    <th>{{ __('app.matiere') }}</th>
                                    <th>{{ __('app.classe') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentEvaluations as $evaluation)
                                    <tr>
                                        <td>{{ $evaluation->date?->format('d/m/Y') ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $evaluation->type == 'examen' ? 'danger' : ($evaluation->type == 'devoir' ? 'warning' : 'info') }}">
                                                {{ __('app.' . $evaluation->type) }}
                                            </span>
                                        </td>
                                        <td>{{ __('app.' . $evaluation->matiere->code_matiere) ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $evaluation->classe?->nom_classe ?? 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('styles')
<style>
.card-hover {
    transition: all 0.2s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.btn i {
    font-size: 1.2rem;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>
@endpush
