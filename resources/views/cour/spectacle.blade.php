@extends('layouts.layout')
@section('title', 'Emplois')
@section('content2')
    <div class="container mt-5">
        <div style="display: flex;">
        <div style="width: 95%; font-size: 1.5rem" id="allAction">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
        <div id="allAction">
        <a href="{{ url('/cour/create') }}" class="btn btn-success btn-sm" title="Ajouter nouvau coure">Ajouter</a>
    </div>
</div>
        <h1 class="text-center mb-4">Emploi du temps</h1>
        <div class="form-group col-md-3">
            <label for="classSelect">Classe :</label>
            <select id="classSelect" class="form-select" >
                @foreach ($classe as $class)
                    <option value="classe{{ $class->id_classe }}">{{ $class->nom_classe }}</option>
                @endforeach
            </select>
        </div>
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered timetable">
                    <thead>
                        <tr>
                            <th>Temps</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyEmploi">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const timetableData = {
            classe1: `
                <tr>
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo1AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo1AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo2AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo2AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo3AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo3AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo4AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo4AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo5AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo5AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine11->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo6AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut1115->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo6AF as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo1AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo1AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo1AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo2AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo2AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo2AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo3AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo3AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo3AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo4AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo4AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo4AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo5AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo5AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo5AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo6AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo6AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo6AS as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo7ASD as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo7ASD as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo7ASD as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut08->hDebut)) }} - {{ date('H:i', strtotime($fine10->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($debutinfo7ASC as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut10->hDebut)) }} - {{ date('H:i', strtotime($fine12->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($milieuinfo7ASC as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
                    <td>{{ date('H:i', strtotime($debut12->hDebut)) }} - {{ date('H:i', strtotime($fine14->hFine)) }}</td>
                    @foreach ($joursSemaine as $jour)
                        @php
                            $matiereFound = false;
                        @endphp
                        @foreach ($fineinfo7ASC as $item)
                            @if ($item->jour === $jour)
                                <td><a href="{{ url('/cour/' . $item->id_cours . '/edit') }}">{{ $item->matiere }}</a></td>
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
