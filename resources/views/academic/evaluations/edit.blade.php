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
                    <form method="POST" action="{{ route('evaluations.update', $evoluation->id_evoluation) }}" class="row g-3">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <x-form.select 
                                name="type" 
                                label="Type d'évaluation" 
                                :value="old('type', $evoluation->type)" 
                                required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir" {{ $evoluation->type == 'devoir' ? 'selected' : '' }}>{{ __('Devoir') }}</option>
                                <option value="controle" {{ $evoluation->type == 'controle' ? 'selected' : '' }}>{{ __('Contrôle') }}</option>
                                <option value="examen" {{ $evoluation->type == 'examen' ? 'selected' : '' }}>{{ __('Examen') }}</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe" 
                                :value="old('id_classe', $evoluation->id_classe)" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ $evoluation->id_classe == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière" 
                                :value="old('matiere', $evoluation->matiere)" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques" {{ $evoluation->matiere == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Français" {{ $evoluation->matiere == 'Français' ? 'selected' : '' }}>Français</option>
                                <option value="Anglais" {{ $evoluation->matiere == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                                <option value="Sciences Physiques" {{ $evoluation->matiere == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                                <option value="Biologie" {{ $evoluation->matiere == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                                <option value="Histoire-Géographie" {{ $evoluation->matiere == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                                <option value="اللغة العربية" {{ $evoluation->matiere == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                                <option value="التربية الإسلامية" {{ $evoluation->matiere == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                                <option value="التربية المدنية" {{ $evoluation->matiere == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                                <option value="التربية البدنية" {{ $evoluation->matiere == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date" 
                                label="Date de l'évaluation" 
                                type="date" 
                                :value="old('date', $evoluation->date)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_debut" 
                                label="Heure de début" 
                                type="time" 
                                :value="old('date_debut', $evoluation->date_debut)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_fin" 
                                label="Heure de fin" 
                                type="time" 
                                :value="old('date_fin', $evoluation->date_fin)" 
                                required />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="description" 
                                label="Description ou instructions (optionnel)" 
                                :value="old('description', $evoluation->description ?? '')" 
                                rows="3"
                                placeholder="Instructions spéciales, matériel autorisé, consignes particulières..." />
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
                <form method="POST" action="{{ route('evaluations.destroy', $evoluation->id_evoluation) }}" class="d-inline">
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
