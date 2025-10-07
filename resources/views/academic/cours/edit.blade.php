@extends('layouts.dashboard')

@section('title', __('app.modifier_cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash me-1"></i>
            {{ __('app.supprimer') }}
        </button>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(request()->has('from_timetable'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>{{ __('app.modification_depuis_emploi') }}</strong> 
                    {{ __('app.certains_champs_verrouilles') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                        {{ __('app.modifier_cours') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('cours.update', $Cours->id_cours) }}">
                        @csrf
                        @method('PATCH')
                        
                        @if(request()->has('from_timetable'))
                            <input type="hidden" name="from_timetable" value="1">
                        @endif

                        <div class="row g-3">
                            <!-- Classe -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.classe') }} <span class="text-danger">*</span>
                                </label>
                                <select name="id_classe" 
                                    class="form-select" 
                                    {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                    required>
                                    <option value="">{{ __('app.selectionner_classe') }}</option>
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id_classe }}" 
                                            {{ old('id_classe', request()->has('from_timetable') ? request('id_classe') : $Cours->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                            {{ $classe->nom_classe }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(request()->has('from_timetable'))
                                    <input type="hidden" name="id_classe" value="{{ request('id_classe', $Cours->id_classe) }}">
                                @endif
                                @error('id_classe')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Enseignant -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.enseignant') }} <span class="text-danger">*</span>
                                </label>
                                <select name="id_enseignant" class="form-select" required>
                                    <option value="">{{ __('app.selectionner_enseignant') }}</option>
                                    @foreach ($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id_enseignant }}" 
                                            {{ old('id_enseignant', $Cours->id_enseignant) == $enseignant->id_enseignant ? 'selected' : '' }}>
                                            {{ $enseignant->prenom }} {{ $enseignant->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_enseignant')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Matière -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.matiere') }} <span class="text-danger">*</span>
                                </label>
                                <select name="id_matiere" class="form-select" required>
                                    <option value="">{{ __('app.selectionner_matiere') }}</option>
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id_matiere }}" 
                                            {{ old('id_matiere', $Cours->id_matiere) == $matiere->id_matiere ? 'selected' : '' }}>
                                            {{ $matiere->nom_matiere }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_matiere')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jour -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.jour') }} <span class="text-danger">*</span>
                                </label>
                                <select name="jour" 
                                    class="form-select" 
                                    {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                    required>
                                    <option value="">{{ __('app.selectionner_jour') }}</option>
                                    <option value="lundi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'lundi' ? 'selected' : '' }}>
                                        {{ __('app.lundi') }}
                                    </option>
                                    <option value="mardi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'mardi' ? 'selected' : '' }}>
                                        {{ __('app.mardi') }}
                                    </option>
                                    <option value="mercredi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'mercredi' ? 'selected' : '' }}>
                                        {{ __('app.mercredi') }}
                                    </option>
                                    <option value="jeudi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'jeudi' ? 'selected' : '' }}>
                                        {{ __('app.jeudi') }}
                                    </option>
                                    <option value="vendredi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'vendredi' ? 'selected' : '' }}>
                                        {{ __('app.vendredi') }}
                                    </option>
                                </select>
                                @if(request()->has('from_timetable'))
                                    <input type="hidden" name="jour" value="{{ request('jour', $Cours->jour) }}">
                                @endif
                                @error('jour')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Heure de début -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.heure_debut') }} <span class="text-danger">*</span>
                                </label>
                                <input type="time" 
                                    name="date_debut" 
                                    class="form-control" 
                                    value="{{ old('date_debut', request()->has('from_timetable') ? request('date_debut') : \Carbon\Carbon::parse($Cours->date_debut)->format('H:i')) }}" 
                                    step="60"
                                    {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                    required>
                                @if(request()->has('from_timetable'))
                                    <input type="hidden" name="date_debut" value="{{ request('date_debut', $Cours->date_debut) }}">
                                @endif
                                @error('date_debut')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Heure de fin -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    {{ __('app.heure_fin') }} <span class="text-danger">*</span>
                                </label>
                                <input type="time" 
                                    name="date_fin" 
                                    class="form-control" 
                                    value="{{ old('date_fin', request()->has('from_timetable') ? request('date_fin') : \Carbon\Carbon::parse($Cours->date_fin)->format('H:i')) }}" 
                                    step="60"
                                    {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                    required>
                                @if(request()->has('from_timetable'))
                                    <input type="hidden" name="date_fin" value="{{ request('date_fin', $Cours->date_fin) }}">
                                @endif
                                @error('date_fin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">{{ __('app.description') }}</label>
                                <textarea name="description" 
                                    class="form-control" 
                                    rows="3" 
                                    placeholder="{{ __('app.description_cours') }}">{{ old('description', $Cours->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-12">
                                <hr class="my-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('cours.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-1"></i>
                                        {{ __('app.annuler') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ __('app.mettre_a_jour') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">{{ __('app.confirmer_suppression_cours') }}</p>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ __('app.action_irreversible') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('app.annuler') }}
                </button>
                <form method="POST" action="{{ route('cours.destroy', $Cours->id_cours) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    @if(request()->has('from_timetable'))
                        <input type="hidden" name="from_timetable" value="1">
                    @endif
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('app.supprimer_definitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
