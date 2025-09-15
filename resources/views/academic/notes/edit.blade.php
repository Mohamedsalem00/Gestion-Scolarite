@extends('layouts.dashboard')

@section('title', __('app.modifier_note'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('notes.index') }}">{{ __('Notes') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Informations sur la note -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('Informations sur la note') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Étudiant :</strong> 
                                @if($note->etudiant)
                                    {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                @else
                                    <span class="text-muted">Étudiant supprimé</span>
                                @endif
                            </p>
                            <p><strong>Classe :</strong> 
                                @if($note->classe)
                                    {{ $note->classe->nom_classe }}
                                @elseif($note->etudiant && $note->etudiant->classe)
                                    {{ $note->etudiant->classe->nom_classe }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Évaluation :</strong> 
                                @if($note->evaluation)
                                    {{ $note->evaluation->matiere }} - {{ ucfirst($note->evaluation->type) }}
                                @else
                                    <span class="text-muted">Évaluation supprimée</span>
                                @endif
                            </p>
                            <p><strong>Date :</strong> 
                                @if($note->evaluation)
                                    {{ \Carbon\Carbon::parse($note->evaluation->date)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de modification -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        {{ __('Modifier la note') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('notes.update', $note->id_note) }}" class="row g-3">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_etudiant" 
                                label="Étudiant" 
                                :value="old('id_etudiant', $note->id_etudiant)" 
                                required>
                                @foreach ($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id_etudiant }}" {{ $note->id_etudiant == $etudiant->id_etudiant ? 'selected' : '' }}>
                                        {{ $etudiant->prenom }} {{ $etudiant->nom }} 
                                        @if($etudiant->classe)
                                            ({{ $etudiant->classe->nom_classe }})
                                        @endif
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_evaluation" 
                                label="Évaluation" 
                                :value="old('id_evaluation', $note->id_evaluation)" 
                                required>
                                @foreach ($evaluations as $evaluation)
                                    <option value="{{ $evaluation->id_evaluation }}" {{ $note->id_evaluation == $evaluation->id_evaluation ? 'selected' : '' }}>
                                        {{ $evaluation->matiere }} - {{ ucfirst($evaluation->type) }} 
                                        ({{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }})
                                        @if($evaluation->classe)
                                            - {{ $evaluation->classe->nom_classe }}
                                        @endif
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="note" 
                                label="Note (sur 20)" 
                                type="number" 
                                step="0.25"
                                min="0"
                                max="20"
                                :value="old('note', $note->note)" 
                                required 
                                placeholder="Ex: 15.5" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="coefficient" 
                                label="Coefficient" 
                                type="number" 
                                step="0.5"
                                min="0.5"
                                max="5"
                                :value="old('coefficient', $note->coefficient ?? 1)" 
                                placeholder="Ex: 1" />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="observation" 
                                label="Observation (optionnel)" 
                                :value="old('observation', $note->observation ?? '')" 
                                rows="3"
                                placeholder="Commentaire sur la performance de l'étudiant..." />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('Supprimer') }}
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">
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
                <p>{{ __('Êtes-vous sûr de vouloir supprimer cette note ?') }}</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Cette action est irréversible et affectera les statistiques de l\'étudiant.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <form method="POST" action="{{ route('notes.destroy', $note->id_note) }}" class="d-inline">
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
