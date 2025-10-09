@extends('layouts.dashboard')

@section('title', __('app.classes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.classes') }}</li>
@endsection



@section('header-actions')
    @admin
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            {{ __('app.add_class') }}
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
                            <i class="fas fa-school fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.total_classes') }}</h6>
                            <h3 class="mb-0">{{ $classes->count() }}</h3>
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
                            <i class="fas fa-user-graduate fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.total_etudiants') }}</h6>
                            <h3 class="mb-0">{{ $classes->sum('etudiants_count') }}</h3>
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
                            <i class="fas fa-level-down-alt fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.niveau_minimum') }}</h6>
                            <h3 class="mb-0">{{ $classes->min('niveau') ?? 0 }}</h3>
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
                            <i class="fas fa-level-up-alt fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.niveau_maximum') }}</h6>
                            <h3 class="mb-0">{{ $classes->max('niveau') ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes Grid -->
    <div class="mb-3">
        <h5 class="mb-4">{{ __('app.liste_classes') }}</h5>
    </div>

    @if($classes->count() > 0)
        <div class="row g-3">
            @foreach($classes as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 hover-lift">
                        <div class="card-body p-3">
                            <!-- Class Header -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1">{{ $item->nom_classe }}</h5>
                                    <span class="badge bg-primary badge-sm">{{ __('app.niveau') }} {{ $item->niveau }}</span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light p-1" type="button" data-bs-toggle="dropdown" style="width: 28px; height: 28px;">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('classes.show', $item->id_classe) }}">
                                                {{ __('app.voir') }}
                                            </a>
                                        </li>
                                        @admin
                                        <li>
                                            <a class="dropdown-item" href="{{ route('classes.edit', $item->id_classe) }}">
                                                {{ __('app.modifier') }}
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('classes.destroy', $item->id_classe) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="dropdown-item text-danger delete-class" data-class-name="{{ $item->nom_classe }}">
                                                    {{ __('app.supprimer') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endadmin
                                    </ul>
                                </div>
                            </div>

                            <!-- Class Stats -->
                            <div class="row text-center g-2 mb-2">
                                <div class="col-6">
                                    <div class="text-muted small">{{ __('app.etudiants') }}</div>
                                    <div class="fw-bold">{{ $item->etudiants->count() }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted small">{{ __('app.enseignants') }}</div>
                                    <div class="fw-bold">{{ $item->enseignants_count ?? 0 }}</div>
                                </div>
                            </div>

                            <div class="row text-center g-2 mb-3 pb-3 border-bottom">
                                <div class="col-6">
                                    <div class="text-muted small">{{ __('app.cours') }}</div>
                                    <div class="fw-bold">{{ $item->cours_count ?? 0 }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted small">{{ __('app.evaluations') }}</div>
                                    <div class="fw-bold">{{ $item->evaluations->count() }}</div>
                                </div>
                            </div>

                            <!-- Quick Action -->
                            <a href="{{ route('classes.show', $item->id_classe) }}" class="btn btn-sm btn-outline-primary w-100">
                                {{ __('app.voir_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-center py-5">
                    <i class="fas fa-school fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">{{ __('app.aucune_classe_creee') }}</p>
                    @admin
                        <a href="{{ route('classes.create') }}" class="btn btn-primary">
                            {{ __('app.creer_premiere_classe') }}
                        </a>
                    @endadmin
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush

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
