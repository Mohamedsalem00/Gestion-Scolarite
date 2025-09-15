<?php
use Carbon\Carbon;
?>
@extends('layouts.layout')
@section('title', 'Examen 3')
@section('content2')
    <div class="container mt-5">
        <header class="bg-light py-4">
            <div class="container">
                <div class="row align-items-center" id="allAction">
                    <div style="width: 5%; font-size: 1.5rem">
                        <a href="{{ url('/evoluation') }}" title="retourne"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div class="col-md-5 text-md-start text-center">
                        <p class="mb-0"> Debut: <strong> 2024-03-18 </strong> | Fine: <strong> 2024-03-22 </strong></p>
                    </div>
                    <div class="col-md-6 text-md-end text-center">
                        <a href="{{ url('/evoluation/create') }}" class="btn btn-success btn-sm">Ajouter</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mt-4">Emploi du temps de l'examen (3)</h1>
                    </div>
                </div>
            </div>
        </header>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="form-floating">
                    <select id="classSelect" class="form-select">
                        @foreach ($classe as $class)
                            <option value="classe{{ $class->id_classe }}">{{ $class->nom_classe }}</option>
                        @endforeach
                    </select>
                    <label for="classSelect">Classe :</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Temps</th>
                                <th class="text-center">Lundi<br><span id="dateLundi"></span></th>
                                <th class="text-center">Mardi<br><span id="dateMardi"></span></th>
                                <th class="text-center">Mercredi<br><span id="dateMercredi"></span></th>
                                <th class="text-center">Jeudi<br><span id="dateJeudi"></span></th>
                                <th class="text-center">Vendredi<br><span id="dateVendredi"></span></th>
                            </tr>
                            <script>
                                var DebutDevoir1 = new Date('2024-03-18');
                                var FineDevoir1 = new Date('2024-03-22');
                                var daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

                                for (var i = 0; i < daysOfWeek.length; i++) {
                                    var dayOfWeek = daysOfWeek[i];
                                    var formattedDate = DebutDevoir1.toISOString().split('T')[0];
                                    var dateSpan = document.getElementById('date' + dayOfWeek);
                                    dateSpan.innerHTML = formattedDate;
                                    DebutDevoir1.setDate(DebutDevoir1.getDate() + 1);
                                }
                            </script>
                        </thead>
                        <tbody class="tbodyEmploi">
                            <!-- Add your timetable data here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const timetableData = {
            classe1: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo1AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo1AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo1AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe2: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo2AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo2AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo2AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe3: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo3AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo3AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo3AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe4: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo4AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo4AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo4AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe5: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo5AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo5AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo5AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe6: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo6AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo6AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo6AF as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe7: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo1AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo1AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo1AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe8: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo2AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo2AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo2AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe9: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo1AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo3AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo3AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe10: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo4AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo4AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo4AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe11: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo5AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo5AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo5AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,

            classe12: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo6AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo6AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo6AS as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe13: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo7ASD as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo7ASD as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo7ASD as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
            classe14: `
            <tr>
                    <td>{{ date('H:i', strtotime($debut08->date_debut)) }} - {{ date('H:i', strtotime($fine10->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo7ASC as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut10->date_debut)) }} - {{ date('H:i', strtotime($fine12->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo7ASC as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>{{ date('H:i', strtotime($debut12->date_debut)) }} - {{ date('H:i', strtotime($fine14->date_fin)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo7ASC as $item)
                            @if (Carbon::parse($item->date)->locale('fr_FR')->isoFormat('dddd') === $jour)
                                <td><a href="{{ url('/evoluation/' . $item->id_evoluation . '/edit') }}">{{ $item->matiere }}</a></td>
                                @php
                                    $matiereFound = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$matiereFound)
                            <td></td>
                        @endif
                    @endforeach
                </tr>`,
        };

        // Function to update the timetable based on the selected class
        function updateTimetable(classValue) {
            const timetable = document.querySelector(".tbodyEmploi");
            const timetableContent = timetableData[classValue];
            timetable.innerHTML = timetableContent;
        }

        // Listen for changes in the class select and update the timetable
        const classSelect = document.getElementById("classSelect");
        classSelect.addEventListener("change", () => {
            const selectedClass = classSelect.value;
            updateTimetable(selectedClass);
        });

        // Initial update to set the timetable based on the default selected class
        updateTimetable(classSelect.value);
    </script>
@endsection
