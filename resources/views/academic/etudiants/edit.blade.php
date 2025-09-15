@extends('layouts.dashboard')

@section('title', __('app.modifier_etudiant'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('etudiants.index') }}">{{ __('Etudiants') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
    <link rel="stylesheet" href="css/style.css">
    <div class="divform" style="padding: 0 6.6rem;">
        <div class="card" style="margin: 20px;">
            <div class="card-header">
                <div style="display: flex;">
                    <div style="width: 35%; font-size: 1.5rem">
                        <a href="{{ url('/etudiant') }}" title="retourne"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div>
                        <h4>Modifier l'étudiant</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3 form-dark" id="myForm" action="{{ route('etudiants.update', ['etudiant' => $etudiant->id_etudiant ]) }}" method="POST">  
                    @csrf
                    @method('PATCH')
                    <div class="col-md-4">
                        <label for="inputName4" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}" required>
                        <div id="nom_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPrenom4" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" required>
                        <div id="prenom_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-4">
                        <label for="inputTelephone" class="form-label">Telephone</label>
                        <input type="number" class="form-control" id="telephone" name="telephone" value="{{ $etudiant->telephone }}" required>
                        <div id="telephone_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-6">
                        <label for="inputAdresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $etudiant->adresse }}" required>
                        <div id="adresse_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-6">
                        <label for="inputDateNaissance" class="form-label">Date-Naissance</label>
                        <input type="date" class="form-control" id="DateNaissance" name="date_naissance" value="{{ $etudiant->date_naissance }}" required>
                        <div id="DateNaissance_error" class="invalid-feedback"></div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="inputClasse" class="form-label">Classe</label>
                        <select id="id_classe" class="form-select" name="id_classe" required>
                            @foreach ($classes as $item)
                                <option value="{{ $item->id_classe }}" {{ $etudiant->id_classe == $item->id_classe ? 'selected' : '' }}>
                                    {{ $item->niveau }}
                                </option>
                            @endforeach
                        </select>
                        <div id="id_classe_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputGenre" class="form-label">Genre</label>
                        <select id="genre" name="genre" class="form-select" required>
                                <option value="Homme"  {{ $etudiant->genre == 'Homme' ? 'selected' : '' }}>Homme</option>
                                <option value="Femme" {{ $etudiant->genre == 'Femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                        <div id="genre_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/regexEtud.js')}}"></script>
@endsection
