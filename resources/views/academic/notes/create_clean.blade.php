@extends('layouts.dashboard')

@section('title', 'Nouvelle Note')

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('notes.index') }}">{{ __('Notes') }}</x-breadcrumb-item>
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
                        <i class="bi bi-journal-plus me-2"></i>
                        {{ __('Ajouter une nouvelle note') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('notes.store') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_etudiant" 
                                label="Étudiant" 
                                :value="old('id_etudiant')" 
                                required>
                                <option value="">{{ __('Sélectionner un étudiant') }}</option>
                                @foreach ($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id_etudiant }}">
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
                                :value="old('id_evaluation')" 
                                required>
                                <option value="">{{ __('Sélectionner une évaluation') }}</option>
                                @foreach ($evaluations as $evaluation)
                                    <option value="{{ $evaluation->id_evaluation }}">
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
                                :value="old('note')" 
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
                                :value="old('coefficient', 1)" 
                                placeholder="Ex: 1" />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="observation" 
                                label="Observation (optionnel)" 
                                :value="old('observation')" 
                                rows="3"
                                placeholder="Commentaire sur la performance de l'étudiant..." />
                        </div>

                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Information :</strong> La note sera automatiquement associée à la classe de l'étudiant et à l'évaluation sélectionnée.
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Retour') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i>
                                    {{ __('Enregistrer la note') }}
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
