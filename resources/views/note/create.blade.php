@extends('layouts.layout')
@section('title', 'Ajouter note')
@section('content2')
    <div class="container mt-5">
        <div style="display: flex;" class="mb-5">
            <div style="width: 38%; font-size: 1.5rem">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div>
                <h1 class="text-center">Ajouter une note</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Informations sur l'élève
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nom : {{ $etudiant->nom }} {{ $etudiant->prenom }}</h5>
                        <p class="card-text">Classe : {{ $etudiant->classe->nom_classe }}</p>
                        <p class="card-text">Matière : {{ $matiere }}</p>
                        <p class="card-text">Type : {{ $type }}</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 offset-md-3">
                        <form action="{{ route('note.store') }}" method="POST" style="padding: 0">
                            @csrf
                            <input type="hidden" name="id_etudiant" value="{{ $etudiant->id_etudiant }}">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="id_classe" value="{{ $etudiant->classe->id_classe }}">
                            <input type="hidden" name="matiere" value="{{ $matiere }}">
                            <div class="input-group  col-6" style="display: flex; flex-wrap: nowrap;">
                                <input type="text" name="note" id="note" class="form-control" placeholder="Note">
                                <span class="input-group-text" id="basic-addon2">/20</span>
                            </div>
                            <div class="mt-3 col-12">
                                <button type="submit" class="btn btn-primary">Ajouter Note</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        const form = document.querySelector("form");
        const noteInput = document.getElementById('note');

        function validateNote() {
            var value = parseInt(noteInput.value);

            if (isNaN(value) || value > 20) {
                noteInput.setCustomValidity("Veuillez entrer une valeur valide jusqu'à 20.");
                return false;
            } else {
                noteInput.setCustomValidity('');
                return true;
            }
        }

        noteInput.addEventListener("input", validateNote);

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            if (
                validateNote()
            ) {
                form.submit();
            }
        });
    </script>
@endsection
