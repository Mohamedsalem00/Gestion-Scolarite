@extends('layouts.layout')
@section('title', 'Paiement de salaire')
@section('content2')
    <style>
        .montant-section {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        
        }

        .montant-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .montant-value {
            font-size: 18px;
            background-color: #f2f2f2;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 2%; font-size: 1.5rem">
                            <a href="{{ url('/paiement/enseignpaiement') }}" title="retourne"><i
                                    class="bi bi-arrow-left"></i></a>
                        </div>
                        <h3 class="card-title text-center mb-4">Créer un paiement de salaire</h3>
                        <hr>
                        <h5 class="card-title"></h5>
                        <div class="montant-section">
                          <label for="montant" class="montant-label">Nom & Prenom:</label>
                          <div class="montant-value"> {{ $enseignant->nom }} {{ $enseignant->prenom }}</div>
                      </div>
                        <div class="montant-section">
                            <label for="montant" class="montant-label">Montant:</label>
                            <div class="montant-value">{{ $salaire }} MUR</div>
                        </div>
                        <div class="montant-section">
                            <label for="montant" class="montant-label">Date:</label>
                            <div class="montant-value">{{ now() }}</div>
                        </div>

                        <form method="POST" id="myPay" action="{{ route('enseignpaiement.update', ['enseignpaiement' => $enseignant->id_enseignant]) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id_enseignant" value="{{ $enseignant->id_enseignant }}">
                            <input type="hidden" name="updated_at" value="{{ now() }}">
                          
                            <div class="form-group">
                                <label for="typepaiement">Type de paiement:</label>
                                <select class="form-select" name="typepaiement" id="typepaiement">
                                    <option value="cash" {{ $enseignpaiement->typepaiement == 'cash' ? 'selected' : '' }}>Espèces</option>
                                    <option value="cheque" {{ $enseignpaiement->typepaiement == 'cheque' ? 'selected' : '' }}>Chèque</option>
                                    <option value="virement" {{ $enseignpaiement->typepaiement == 'virement' ? 'selected' : '' }}>Virement bancaire</option>
                                </select>
                                <div id="typepaiement_error" class="invalid-feedback"></div>
                            </div>
                            <button class="btn btn-primary" type="submit">Payer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/regexPaiementens.js')}}"></script>
@endsection
