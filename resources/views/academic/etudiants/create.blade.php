@extends('layouts.dashboard')

@section('title', __('app.ajouter_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.ajouter_etudiant') }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('app.ajouter_etudiant') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('etudiants.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">{{ __('app.nom') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">{{ __('app.prenom') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                           id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('app.email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">{{ __('app.telephone') }} <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                           id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">{{ __('app.date_naissance') }} <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                           id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                    @error('date_naissance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="genre" class="form-label">{{ __('app.genre') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('genre') is-invalid @enderror" 
                                            id="genre" name="genre" required>
                                        <option value="">{{ __('app.choisir_genre') }}</option>
                                        <option value="masculin" {{ old('genre') == 'masculin' ? 'selected' : '' }}>{{ __('app.masculin') }}</option>
                                        <option value="feminin" {{ old('genre') == 'feminin' ? 'selected' : '' }}>{{ __('app.feminin') }}</option>
                                    </select>
                                    @error('genre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_classe" class="form-label">{{ __('app.classe') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_classe') is-invalid @enderror" 
                                            id="id_classe" name="id_classe" required>
                                        <option value="">{{ __('app.choisir_classe') }}</option>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                                {{ $classe->nom_classe }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_classe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">{{ __('app.adresse') }}</label>
                                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                                           id="adresse" name="adresse" value="{{ old('adresse') }}">
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                                {{ __('app.annuler') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('app.enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
