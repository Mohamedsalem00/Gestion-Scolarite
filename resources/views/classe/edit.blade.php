@extends('layouts.layout')
@section('title', 'Modifier')
@section('content2')
    <div class="container mt-5">
        <div style="width: 38%; font-size: 1.5rem">
            <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Modifier classe de scolarité</h3>
                        <form id="formClasse" style="padding: 0 3rem;"
                            action="{{ route('classe.update', ['classe' => $Classe->id_classe]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="inputClasse" class="form-label">Nom de la classe</label>
                                <input type="text" class="form-control" id="nom_classe" name="nom_classe" required
                                    value="{{ $Classe->nom_classe }}">
                            </div>
                            <div class="mb-3">
                                <label for="inputNiveau" class="form-label">Niveau de la classe</label>
                                <input type="text" class="form-control" id="niveau" name="niveau" required
                                    value="{{ $Classe->niveau }}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
