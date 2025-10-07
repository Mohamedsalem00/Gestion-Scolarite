@extends('layouts.dashboard')

@section('title', __('app.modifier_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
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
                        {{ __('Modifier l\'évaluation') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluations.update', $evaluation) }}" class="row g-3">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <x-form.select 
                                name="type" 
                                label="Type d'évaluation" 
                                :value="old('type', $evaluation->type)" 
                                required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir" {{ $evaluation->type == 'devoir' ? 'selected' : '' }}>{{ __('Devoir') }}</option>
                                <option value="controle" {{ $evaluation->type == 'controle' ? 'selected' : '' }}>{{ __('Contrôle') }}</option>
                                <option value="examen" {{ $evaluation->type == 'examen' ? 'selected' : '' }}>{{ __('Examen') }}</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="titre" 
                                label="Titre de l'évaluation" 
                                :value="old('titre', $evaluation->titre)" 
                                placeholder="Ex: Devoir de mathématiques sur les équations" />
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe" 
                                :value="old('id_classe', $evaluation->id_classe)" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ $evaluation->id_classe == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_matiere" 
                                label="Matière" 
                                :value="old('id_matiere', $evaluation->id_matiere)" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" {{ $evaluation->id_matiere == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date" 
                                label="Date de l'évaluation" 
                                type="date" 
                                :value="old('date', $evaluation->date)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_debut" 
                                label="Heure de début" 
                                type="time" 
                                :value="old('date_debut', $evaluation->date_debut)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_fin" 
                                label="Heure de fin" 
                                type="time" 
                                :value="old('date_fin', $evaluation->date_fin)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="note_max" 
                                label="Note maximale" 
                                type="number" 
                                step="0.01"
                                min="0"
                                :value="old('note_max', $evaluation->note_max)" 
                                required 
                                placeholder="20" />
                        </div>



                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('Supprimer') }}
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
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
                <p>{{ __('Êtes-vous sûr de vouloir supprimer cette évaluation ?') }}</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Cette action supprimera également toutes les notes associées.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <form method="POST" action="{{ route('evaluations.destroy', $evaluation) }}" class="d-inline">
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
