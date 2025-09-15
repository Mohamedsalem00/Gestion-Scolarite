@extends('layouts.dashboard')

@section('title', __('app.nouvelle_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
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
                        <i class="bi bi-clipboard-plus me-2"></i>
                        {{ __('Programmer une nouvelle évaluation') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluations.store') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <x-form.select 
                                name="type" 
                                label="Type d'évaluation" 
                                :value="old('type')" 
                                required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir">{{ __('Devoir') }}</option>
                                <option value="controle">{{ __('Contrôle') }}</option>
                                <option value="examen">{{ __('Examen') }}</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe" 
                                :value="old('id_classe')" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}">
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière" 
                                :value="old('matiere')" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques">Mathématiques</option>
                                <option value="Français">Français</option>
                                <option value="Anglais">Anglais</option>
                                <option value="Sciences Physiques">Sciences Physiques</option>
                                <option value="Biologie">Biologie</option>
                                <option value="Histoire-Géographie">Histoire-Géographie</option>
                                <option value="اللغة العربية">اللغة العربية</option>
                                <option value="التربية الإسلامية">التربية الإسلامية</option>
                                <option value="التربية المدنية">التربية المدنية</option>
                                <option value="التربية البدنية">التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date" 
                                label="Date de l'évaluation" 
                                type="date" 
                                :value="old('date')" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_debut" 
                                label="Heure de début" 
                                type="time" 
                                :value="old('date_debut')" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_fin" 
                                label="Heure de fin" 
                                type="time" 
                                :value="old('date_fin')" 
                                required />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="description" 
                                label="Description ou instructions (optionnel)" 
                                :value="old('description')" 
                                rows="3"
                                placeholder="Instructions spéciales, matériel autorisé, consignes particulières..." />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Retour') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i>
                                    {{ __('Programmer l\'évaluation') }}
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
