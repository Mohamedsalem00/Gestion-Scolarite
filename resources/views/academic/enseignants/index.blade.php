@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_enseignant') }}
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.total_enseignants') }}</h6>
                            <h3 class="mb-0">{{ $enseignant->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-check fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.actifs_ce_mois') }}</h6>
                            <h3 class="mb-0">{{ $enseignant->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-book fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.matieres_enseignees') }}</h6>
                            <h3 class="mb-0">{{ $enseignant->pluck('matiere')->unique()->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">{{ __('app.classes_assignees') }}</h6>
                            <h3 class="mb-0">{{ $enseignant->whereNotNull('id_classe')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enseignants Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">{{ __('app.liste_enseignants') }}</h5>
            @if($enseignant->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="border-bottom">
                                <th class="text-muted fw-normal">{{ __('app.nom_complet') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.email') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.telephone') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.matiere') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.classe') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.date_ajout') }}</th>
                                <th class="text-muted fw-normal text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignant as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->prenom }} {{ $item->nom }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $item->email }}" class="text-decoration-none">
                                            {{ $item->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $item->telephone }}" class="text-decoration-none">
                                            {{ $item->telephone }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->matiere }}</span>
                                    </td>
                                    <td>
                                        @if($item->classe)
                                            <span class="badge bg-secondary">{{ $item->classe->nom_classe ?? 'N/A' }}</span>
                                        @else
                                            <span class="text-muted">{{ __('app.non_assigne') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</small>
                                    </td>
                                    <td class="text-center">
                                        @include('academic.enseignants.partials.actions', ['teacher' => $item])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-chalkboard-teacher fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">{{ __('app.aucun_enseignant_ajoute') }}</p>
                    @admin
                        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
                            {{ __('app.ajouter_premier_enseignant') }}
                        </a>
                    @endadmin
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Voulez-vous vraiment supprimer cet enregistrement ?",
            text: "Si vous le supprimez, il disparaîtra pour toujours.",
            icon: "warning",
            type: "warning",
            buttons: ["Annuler", "Oui!"],
            confirmButtonColor: '#d33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endpush
