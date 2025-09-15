@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @can('create', App\Models\Enseignant::class)
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            {{ __('app.ajouter_enseignant') }}
        </a>
    @endcan
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="{{__('app.total_enseignants')}}" 
                :value="$enseignant->count()" 
                icon="bi-person-badge"
                color="primary" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="{{__('app.actifs_ce_mois')}}" 
                :value="$enseignant->where('created_at', '>=', now()->startOfMonth())->count()" 
                icon="bi-calendar-check"
                color="success" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="{{__('app.matieres_enseignees')}}" 
                :value="$enseignant->pluck('matiere')->unique()->count()" 
                icon="bi-book"
                color="info" />
        </div>
        <div class="col-lg-3 col-md-6">
            <x-cards.info-card 
                title="{{__('app.classes_assignees')}}" 
                :value="$enseignant->whereNotNull('id_classe')->count()" 
                icon="bi-diagram-3"
                color="warning" />
        </div>
    </div>

    <!-- Enseignants Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                {{ __('app.liste_enseignants') }}
            </h5>
        </div>
        <div class="card-body">
            @if($enseignant->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('app.nom_complet') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.telephone') }}</th>
                                <th>{{ __('app.matiere') }}</th>
                                <th>{{ __('app.classe') }}</th>
                                <th>{{ __('app.date_ajout') }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignant as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <i class="bi bi-person text-muted"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $item->nom }} {{ $item->prenom }}</strong>
                                            </div>
                                        </div>
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
                                    <td>
                                        @include('academic.enseignants.partials.actions', ['teacher' => $item])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-user-tie text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">{{ __('app.no_data') }}</h4>
                    <p class="text-muted">{{ __('app.aucun_enseignant_ajoute') }}</p>
                    @can('create', App\Models\Enseignant::class)
                        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>
                            {{ __('app.ajouter_premier_enseignant') }}
                        </a>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
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
@endsection
