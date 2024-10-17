@extends('layouts.layout')
@section('title', 'etudiant paiement')
@section('content2')
    <div class="container" id="container">
        <div class="row" style="margin: 20px;">
            <div class="col-12">
                <div class="card" id="card">
                    <div class="card-header" style="display: flex;">
                        <div style="width: 30%; font-size: 1.5rem">
                            <a href="{{ url('/paiement') }}" title="retourne"><i class="bi bi-arrow-left"></i></a>
                        </div>
                        <h4>Reception des Frais d'Étudiants</h4>
                    </div>
                 
                        <div class="card-body">
                            @if (count($etudiant) == 0)
                                <p>ll n'y a aucun etudiant á Afficher</p>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom & Prénoms</th>
                                            <th>frais mensuels</th>
                                            <th>statu</th>
                                            <th id="allAction">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($etudiant as $item)
                                            @if (is_object($item))
                                                <tr>
                                                    <td>
                                                        {{ $item->nom }} {{ $item->prenom }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $frais = 0;
                                                            if (in_array($item->classe->id_classe, [1, 2, 3, 4, 5, 6])) {
                                                                $frais = 700;
                                                            } elseif (in_array($item->classe->id_classe, [7, 8, 9, 10, 11, 12])) {
                                                                $frais = 900;
                                                            } elseif (in_array($item->classe->id_classe, [13, 14])) {
                                                                $frais = 1200;
                                                            }
                                                        @endphp
                                                        {{ $frais }} MUR
                                                    </td>
                                                    <td>
                                                        @php
                                                            $hasPayment = false;
                                                        @endphp
                                                        @foreach ($etudepaiement as $ite)
                                                            @php
                                                                $paymentDate = strtotime($ite->updated_at);
                                                                $currentDate = strtotime(date('Y-m-d'));
                                                                $timetopaye = strtotime('+1 month', $paymentDate);
                                                            @endphp
                                                            @if ($item->id_etudiant === $ite->id_etudiant)
                                                                @if ($timetopaye > $currentDate)
                                                                    <strong class="rounded-pill badge bg-success badge-sm" style="font-size: 0.8rem;">Les frais ont été payés</strong>
                                                                @elseif ($timetopaye === $currentDate)
                                                                    <strong class="rounded-pill badge bg-warning badge-sm" style="font-size: 0.8rem; color: #333333;">Aucun frais n'a été payés ce mois-ci</strong>
                                                                @else
                                                                    <strong class="rounded-pill badge bg-danger badge-sm" style="font-size: 0.8rem;">Le paiement est en retard</strong>
                                                                @endif
                                                                @php
                                                                    $hasPayment = true;
                                                                @endphp
                                                                @break
                                                            @endif
                                                        @endforeach
                                                        @if (!$hasPayment)
                                                            <strong class="rounded-pill badge bg-warning badge-sm" style="font-size: 0.8rem; color: #333333;">Payer les frais du premier mois</strong>
                                                        @endif
                                                    </td>
                                                <td>
                                                    @php
                                                    $hasPayment = false;
                                                @endphp
                                                @foreach ($etudepaiement as $ite)
                                                    @php
                                                        $paymentDate = strtotime($ite->updated_at);
                                                        $currentDate = strtotime(date('Y-m-d'));
                                                        $timetopaye = strtotime('+1 month', $paymentDate);
                                                    @endphp
                                                    @if ($item->id_etudiant === $ite->id_etudiant)
                                                        @if ($timetopaye > $currentDate)
                                                        <button class="btn btn-primary btn-sm" style="opacity: 0.5; cursor: not-allowed;">Déjà payer</button>
                                                        @else
                                                        <a class="btn btn-primary btn-sm" href="{{ route('etudepaiement.edit', ['id' => $ite->id_paiements , 'frais' => $frais]) }}">Payer ce mois-ci</a>
                                                        @endif
                                                        @php
                                                            $hasPayment = true;
                                                        @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if (!$hasPayment)
                                                <a class="btn btn-primary btn-sm"
                                                href="{{ route('etudepaiement.create', ['id' => $item->id_etudiant, 'frais' => $frais]) }}">Payer</a>
                                                @endif                                           
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                    @endif
                    </tbody>
                    </table>
               
            </div>
        </div>
    </div>
</div>
</div>

@endsection
