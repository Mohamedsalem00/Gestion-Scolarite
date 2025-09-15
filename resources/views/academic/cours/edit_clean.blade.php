@extends('layouts.dashboard')

@section('title', 'Modifier un Cours')

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('cours.index') }}">{{ __('Cours') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Formulaire de modification -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        {{ __('Modifier le cours') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cours.update', $Cours->id_cours) }}" class="row g-3">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe" 
                                :value="old('id_classe', $Cours->id_classe)" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ $Cours->id_classe == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_enseignant" 
                                label="Enseignant" 
                                :value="old('id_enseignant', $Cours->id_enseignant)" 
                                required>
                                <option value="">{{ __('Sélectionner un enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" {{ $Cours->id_enseignant == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }} - {{ $enseignant->matiere }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière" 
                                :value="old('matiere', $Cours->matiere)" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques" {{ $Cours->matiere == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Français" {{ $Cours->matiere == 'Français' ? 'selected' : '' }}>Français</option>
                                <option value="Anglais" {{ $Cours->matiere == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                                <option value="Sciences Physiques" {{ $Cours->matiere == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                                <option value="Biologie" {{ $Cours->matiere == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                                <option value="Histoire-Géographie" {{ $Cours->matiere == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                                <option value="اللغة العربية" {{ $Cours->matiere == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                                <option value="التربية الإسلامية" {{ $Cours->matiere == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                                <option value="التربية المدنية" {{ $Cours->matiere == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                                <option value="التربية البدنية" {{ $Cours->matiere == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="jour" 
                                label="Jour de la semaine" 
                                :value="old('jour', $Cours->jour)" 
                                required>
                                <option value="">{{ __('Sélectionner un jour') }}</option>
                                <option value="lundi" {{ strtolower($Cours->jour) == 'lundi' ? 'selected' : '' }}>{{ __('Lundi') }}</option>
                                <option value="mardi" {{ strtolower($Cours->jour) == 'mardi' ? 'selected' : '' }}>{{ __('Mardi') }}</option>
                                <option value="mercredi" {{ strtolower($Cours->jour) == 'mercredi' ? 'selected' : '' }}>{{ __('Mercredi') }}</option>
                                <option value="jeudi" {{ strtolower($Cours->jour) == 'jeudi' ? 'selected' : '' }}>{{ __('Jeudi') }}</option>
                                <option value="vendredi" {{ strtolower($Cours->jour) == 'vendredi' ? 'selected' : '' }}>{{ __('Vendredi') }}</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_debut" 
                                label="Heure de début" 
                                type="time" 
                                :value="old('date_debut', $Cours->date_debut)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_fin" 
                                label="Heure de fin" 
                                type="time" 
                                :value="old('date_fin', $Cours->date_fin)" 
                                required />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="description" 
                                label="Description (optionnel)" 
                                :value="old('description', $Cours->description ?? '')" 
                                rows="3"
                                placeholder="Description du cours ou notes particulières..." />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('Supprimer') }}
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('cours.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i>
                                        {{ __('Retour') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-1"></i>
                                        {{ __('Mettre à jour') }}
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

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Confirmer la suppression') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Êtes-vous sûr de vouloir supprimer ce cours ?') }}</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Cette action est irréversible.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <form method="POST" action="{{ route('cours.destroy', $Cours->id_cours) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('Supprimer définitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
