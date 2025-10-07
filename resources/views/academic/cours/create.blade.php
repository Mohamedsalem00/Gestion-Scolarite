@extends('layouts.dashboard')

@section('title', __('app.programmer_cours'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('cours.index') }}">{{ __('Cours') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-plus me-2"></i>
                        {{ __('Programmer un nouveau cours') }}
                    </h5>
                </div>
                <div class="card-body">
                    @if(request()->has('from_timetable'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Pré-rempli depuis l'emploi du temps!</strong>
                            Les champs classe, jour et horaires sont verrouillés. Veuillez compléter les informations manquantes (enseignant et matière).
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cours.store') }}" class="row g-3">
                        @csrf
                        
                        @if(request()->has('from_timetable'))
                            <input type="hidden" name="from_timetable" value="1">
                        @endif

                        <div class="col-md-6">
                            <label class="form-label">Classe <span class="text-danger">*</span></label>
                            <select name="id_classe" 
                                class="form-select" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" 
                                        {{ (old('id_classe', request('id_classe')) == $classe->id_classe) ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="id_classe" value="{{ request('id_classe') }}">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Enseignant <span class="text-danger">*</span></label>
                            <select name="id_enseignant" class="form-select" required>
                                <option value="">{{ __('Sélectionner un enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" 
                                        {{ old('id_enseignant') == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }} - {{ $enseignant->matiere }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Matière <span class="text-danger">*</span></label>
                            <select name="id_matiere" class="form-select" required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" 
                                        {{ old('id_matiere') == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jour de la semaine <span class="text-danger">*</span></label>
                            <select name="jour" 
                                class="form-select" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('Sélectionner un jour') }}</option>
                                <option value="lundi" {{ (old('jour', request('jour')) == 'lundi') ? 'selected' : '' }}>{{ __('Lundi') }}</option>
                                <option value="mardi" {{ (old('jour', request('jour')) == 'mardi') ? 'selected' : '' }}>{{ __('Mardi') }}</option>
                                <option value="mercredi" {{ (old('jour', request('jour')) == 'mercredi') ? 'selected' : '' }}>{{ __('Mercredi') }}</option>
                                <option value="jeudi" {{ (old('jour', request('jour')) == 'jeudi') ? 'selected' : '' }}>{{ __('Jeudi') }}</option>
                                <option value="vendredi" {{ (old('jour', request('jour')) == 'vendredi') ? 'selected' : '' }}>{{ __('Vendredi') }}</option>
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="jour" value="{{ request('jour') }}">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Heure de début <span class="text-danger">*</span></label>
                            <input type="time" 
                                name="date_debut" 
                                class="form-control" 
                                value="{{ old('date_debut', request('date_debut')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_debut" value="{{ request('date_debut') }}">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Heure de fin <span class="text-danger">*</span></label>
                            <input type="time" 
                                name="date_fin" 
                                class="form-control" 
                                value="{{ old('date_fin', request('date_fin')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_fin" value="{{ request('date_fin') }}">
                            @endif
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="description" 
                                label="Description (optionnel)" 
                                :value="old('description')" 
                                rows="3"
                                placeholder="Description du cours ou notes particulières..." />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('cours.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Retour') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i>
                                    {{ __('Programmer le cours') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
