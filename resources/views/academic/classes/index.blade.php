@extends('layouts.dashboard')

@section('title', __('app.classes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.classes') }}</li>
@endsection

@section('header-actions')
    @can('create', App\Models\Classe::class)
        <a href="{{ route('academic.classes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            {{ __('app.add_class') }}
        </a>
    @endcan
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-cards.info-card
                title="{{ __('app.total_classes') }}"
                :value="$classes->count()"
                icon="fas fa-school"
                color="primary"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Total Étudiants"
                :value="$classes->sum(function($c) { return $c->etudiants->count(); })"
                icon="fas fa-user-graduate"
                color="success"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Niveau Minimum"
                :value="$classes->min('niveau') ?? 0"
                icon="fas fa-level-down-alt"
                color="info"
            />
        </div>
        <div class="col-md-3">
            <x-cards.info-card
                title="Niveau Maximum"
                :value="$classes->max('niveau') ?? 0"
                icon="fas fa-level-up-alt"
                color="warning"
            />
        </div>
    </div>

    <!-- Classes Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Liste des Classes
            </h5>
        </div>
        <div class="card-body">
            @if($classes->count() > 0)
                                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('app.class_name') }}</th>
                                <th>{{ __('app.level') }}</th>
                                <th>{{ __('app.total_etudiants') }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $item)
                            <tr>
                                <td>{{ $item->nom_classe }}</td>
                                <td>Niveau {{ $item->niveau }}</td>
                                <td>{{ $item->etudiants->count() }} étudiants</td>
                                <td>
                                    @include('academic.classes.partials.actions', ['item' => $item])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-school text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">Aucune classe n'a été créée pour le moment.</p>
                    @can('create', App\Models\Classe::class)
                        <a href="{{ route('academic.classes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Créer la première classe
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
    document.querySelectorAll('.delete-class').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const className = this.dataset.className;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer la classe "${className}" ?`)) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
