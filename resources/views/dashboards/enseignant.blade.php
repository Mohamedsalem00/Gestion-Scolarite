@extends('layouts.dashboard')

@section('title', __('app.tableau_bord_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('app.tableau_de_bord') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="mb-2">Bonjour, {{ $teacher->prenom }} {{ $teacher->nom }}!</h2>
                            <p class="mb-0 opacity-75">
                                <i class="bi bi-geo-alt me-1"></i>
                                Classe: {{ $stats['classe_name'] }} | 
                                <i class="bi bi-book me-1"></i>
                                Matière: {{ $teacher->matiere }}
                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="bi bi-person-workspace fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people-fill text-primary fs-2"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-primary mb-1">{{ $stats['students_count'] }}</h3>
                    <p class="text-muted mb-0">{{ __('app.etudiants') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-book-fill text-success fs-2"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-success mb-1">{{ $stats['courses_count'] }}</h3>
                    <p class="text-muted mb-0">{{ __('app.cours') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-clipboard-check-fill text-warning fs-2"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-warning mb-1">{{ $stats['evaluations_count'] }}</h3>
                    <p class="text-muted mb-0">{{ __('app.evaluations') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-calendar3 text-info fs-2"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-info mb-1">{{ \Carbon\Carbon::now()->format('d/m') }}</h3>
                    <p class="text-muted mb-0">{{ __('app.aujourdhui') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>
                        {{ __('app.actions_rapides') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('enseignant.mes-etudiants') }}" class="btn btn-outline-primary">
                            <i class="bi bi-people me-2"></i>
                            {{ __('app.voir_mes_etudiants') }}
                        </a>
                        <a href="{{ route('enseignant.saisir-notes') }}" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square me-2"></i>
                            {{ __('app.saisir_des_notes') }}
                        </a>
                        <a href="{{ route('enseignant.mes-cours') }}" class="btn btn-outline-info">
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ __('app.mon_emploi_du_temps') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Students Preview -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-2"></i>
                        {{ __('app.mes_etudiants') }} ({{ $students->count() }})
                    </h5>
                    @if($students->count() > 0)
                        <a href="{{ route('enseignant.mes-etudiants') }}" class="btn btn-sm btn-outline-primary">
                            {{ __('app.voir_tous') }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('app.nom_complet') }}</th>
                                        <th>{{ __('app.email') }}</th>
                                        <th>{{ __('app.telephone') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students->take(5) as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                                        {{ strtoupper(substr($student->prenom, 0, 1)) }}
                                                    </div>
                                                    {{ $student->prenom }} {{ $student->nom }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                                    {{ $student->email }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($student->telephone)
                                                    <a href="tel:{{ $student->telephone }}" class="text-decoration-none">
                                                        {{ $student->telephone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($students->count() > 5)
                            <div class="text-center mt-3">
                                <small class="text-muted">... et {{ $students->count() - 5 }} autres étudiants</small>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">{{ __('app.aucun_etudiant_assigné') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Evaluations -->
    @if($recentEvaluations->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="mb-0">
                            <i class="bi bi-clipboard-check me-2"></i>
                            {{ __('app.evaluations_recentes') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('app.titre') }}</th>
                                        <th>{{ __('app.type') }}</th>
                                        <th>{{ __('app.cours') }}</th>
                                        <th>{{ __('app.date') }}</th>
                                        <th>{{ __('app.statut') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentEvaluations as $evaluation)
                                        <tr>
                                            <td>{{ $evaluation->titre }}</td>
                                            <td>
                                                <span class="badge bg-{{ $evaluation->type == 'examen' ? 'danger' : 'info' }}">
                                                    {{ ucfirst($evaluation->type) }}
                                                </span>
                                            </td>
                                            <td>{{ $evaluation->cours->matiere ?? 'N/A' }}</td>
                                            <td>{{ $evaluation->date ? \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') : 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-success">{{ __('app.actif') }}</span>
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
</div>
@endsection
