@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-search"></i> Rechercher mes Notes</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rechercher-notes.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule d'Étudiant</label>
                            <input type="text" 
                                   class="form-control @error('matricule') is-invalid @enderror" 
                                   id="matricule" 
                                   name="matricule" 
                                   value="{{ old('matricule') }}"
                                   placeholder="Entrez votre matricule (ex: ETU0001)"
                                   required>
                            @error('matricule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </form>

                    @if($etudiant)
                        <hr>
                        <div class="alert alert-info">
                            <h5><i class="fas fa-user"></i> Informations de l'Étudiant</h5>
                            <p><strong>Nom:</strong> {{ $etudiant->prenom }} {{ $etudiant->nom }}</p>
                            <p><strong>Matricule:</strong> {{ $etudiant->matricule }}</p>
                            <p><strong>Classe:</strong> {{ $etudiant->classe->nom_classe ?? 'Non assigné' }}</p>
                        </div>

                        @if($notes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Matière</th>
                                            <th>Type d'Évaluation</th>
                                            <th>Note</th>
                                            <th>Note sur</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notes as $note)
                                            <tr>
                                                <td>{{ $note->evaluation->cours->nom_cours ?? 'N/A' }}</td>
                                                <td>{{ $note->evaluation->type_evaluation ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $note->note_obtenue >= ($note->note_totale * 0.6) ? 'success' : 'danger' }}">
                                                        {{ $note->note_obtenue }}
                                                    </span>
                                                </td>
                                                <td>{{ $note->note_totale }}</td>
                                                <td>{{ $note->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                Aucune note trouvée pour cet étudiant.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
