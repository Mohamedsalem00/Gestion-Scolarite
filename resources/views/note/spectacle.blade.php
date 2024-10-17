@extends('layouts.layout')
@section('title', 'Relevé de Notes')

@section('content2')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .student-info p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .notes-table {
            margin-top: 20px;
        }

        .totals-row {
            font-weight: bold;
        }
    </style>

    <div class="container">
        <div style="display: flex;" class="mb-5">
            <div style="width: 22%; font-size: 1.5rem" id="allAction">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div>
                <h1 class="text-center">Relevé de Notes {{$trimestre}}</h1>
            </div>
        </div>


        <div class="student-info">
            <p>Nom de l'étudiant: {{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
            <p>Matricule: </strong>
                E{{ $etudiant->id_etudiant }}
            </p>
            <p>Classe: {{ $etudiant->classe->nom_classe }}</p>
            
        </div>

        <table class="table table-bordered notes-table">
            <thead class="thead-light">
                <tr>
                    <th>Matière</th>
                    <th>Devoire</th>
                    <th>Examen</th>
                </tr>
            </thead>
            @php
                $devoirTotal = 0;
                $devoirCount = 0;
                $examenTotal = 0;
                $examenCount = 0;
                $moyenne = 'N/A';
                $total = 'N/A';
                $noteExists = true;
                
                $classeId = $etudiant->classe->id_classe; // Example class ID
                
                $matiereOptions = [
                    1 => ['اللغة العربية', 'Calcule', 'التربية الإسلامية'],
                    2 => ['اللغة العربية', 'Calcule', 'Français', 'Sciences naturelles', 'التربية الإسلامية', 'التربية المدنية', 'التاريخ و الجغرافيا'],
                    3 => ['اللغة العربية', 'Calcule', 'Français', 'Sciences naturelles', 'التربية الإسلامية', 'التربية المدنية', 'التاريخ و الجغرافيا'],
                    4 => ['اللغة العربية', 'Calcule', 'Français', 'Sciences naturelles', 'التربية الإسلامية', 'التربية المدنية', 'التاريخ و الجغرافيا'],
                    5 => ['اللغة العربية', 'Calcule', 'Français', 'Sciences naturelles', 'التربية الإسلامية', 'التربية المدنية', 'التاريخ و الجغرافيا'],
                    6 => ['Mathématiques', 'اللغة العربية', 'Français', 'Sciences naturelles', 'التربية الإسلامية', 'التربية المدنية', 'التاريخ و الجغرافيا'],
                    7 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles', 'التاريخ و الجغرافيا', 'التربية المدنية'],
                    8 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles', 'التاريخ و الجغرافيا', 'التربية المدنية'],
                    9 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles', 'التاريخ و الجغرافيا', 'التربية المدنية'],
                    10 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles', 'التاريخ و الجغرافيا', 'التربية المدنية'],
                    11 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'التربية المدنية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles'],
                    12 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'التربية المدنية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles'],
                    13 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles'],
                    14 => ['Mathématiques', 'Français', 'Anglais', 'التربية الإسلامية', 'اللغة العربية', 'Physique Chimie', 'Sciences naturelles'],
                ];
            @endphp

            <tbody>


                @foreach ($matiereOptions[$classeId] as $matiere)
                    <tr>
                        <td>{{ $matiere }}</td>
                        @php
                            $devoirItem = $devoire1->where('matiere', $matiere)->first();
                            $examenItem = $examen1->where('matiere', $matiere)->first();
                            $devoirNote = $devoirItem && $devoirItem->note ? $devoirItem->note . '/20' : 'Notes pas encore ajoutées';
                            $examenNote = $examenItem && $examenItem->note ? $examenItem->note . '/20' : 'Notes pas encore ajoutées';
                            if ($devoirItem && $devoirItem->note) {
                                $devoirTotal += $devoirItem->note;
                                $devoirCount++;
                            } else {
                                $noteExists = false; // Set the flag if a note is missing
                            }
                            if ($examenItem && $examenItem->note) {
                                $examenTotal += $examenItem->note;
                                $examenCount++;
                            } else {
                                $noteExists = false; // Set the flag if a note is missing
                            }
                        @endphp
                        <td>{{ $devoirNote }}</td>
                        <td>{{ $examenNote }}</td>
                    </tr>
                @endforeach

                @if ($devoirCount === $examenCount && $noteExists && $devoirCount > 0)
                    @php
                        $devoirAverage = $devoirTotal / $devoirCount;
                        $examenAverage = $examenTotal / $examenCount;
                        $moyenne = $devoirAverage * 0.6 + $examenAverage * 0.4 . '/20';
                        $total = $devoirTotal + $examenTotal . '/' . ($devoirCount + $examenCount) * 20;
                    @endphp
                @endif

                <tr class="totals-row">
                    <td>Total</td>
                    <td colspan="2">{{ $total }}</td>
                </tr>
                <tr class="totals-row">
                    <td>Moyenne</td>
                    <td colspan="2">{{ $moyenne }}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection
