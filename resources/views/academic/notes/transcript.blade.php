@extends('layouts.dashboard')

@section('title', __('app.releve_de_notes') . ' - ' . $etudiant->nom . ' ' . $etudiant->prenom)

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('app.tableau_de_bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('rapports.notes.transcript-index') }}">{{ __('app.relevés_de_notes') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ $etudiant->nom }} {{ $etudiant->prenom }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Simple Actions -->
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <h3>{{ __('app.releve_de_notes') }}</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-outline-secondary">
                {{ __('app.retour') }}
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                {{ __('app.imprimer') }}
            </button>
        </div>
    </div>

    <!-- Simple Transcript -->
    <div class="bg-white rounded border">
        <div class="p-4">
            <!-- Simple Header -->
            <div class="text-center mb-4">
                <h2 class="mb-1">{{ __('app.releve_de_notes') }}</h2>
                @if($trimestreInfo)
                    <p class="text-muted">{{ $trimestreInfo['name'] }} - {{ __('app.annee_scolaire') }} {{ $academicYear }}</p>
                @else
                    <p class="text-muted">{{ __('app.annee_scolaire') }} {{ $academicYear }}</p>
                @endif
                <hr>
            </div>

            <!-- Year and Trimester Selector -->
            <div class="row mb-4 no-print">
                <div class="col-md-6">
                    <label for="yearSelect" class="form-label">{{ __('app.annee_scolaire') }}</label>
                    <select id="yearSelect" class="form-select" onchange="changeYear()">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == $academicYear ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="trimestreSelect" class="form-label">{{ __('app.trimestre') }}</label>
                    <select id="trimestreSelect" class="form-select" onchange="changeTrimestre()">
                        <option value="" {{ !$trimestre ? 'selected' : '' }}>{{ __('app.tous_les_trimestres') }}</option>
                        <option value="1" {{ $trimestre == '1' ? 'selected' : '' }}>{{ __('app.premier_trimestre') }}</option>
                        <option value="2" {{ $trimestre == '2' ? 'selected' : '' }}>{{ __('app.deuxieme_trimestre') }}</option>
                        <option value="3" {{ $trimestre == '3' ? 'selected' : '' }}>{{ __('app.troisieme_trimestre') }}</option>
                    </select>
                </div>
            </div>

            <!-- Student Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>{{ __('app.nom') }}:</strong></td>
                            <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('app.matricule') }}:</strong></td>
                            <td>{{ $etudiant->matricule }}</td>
                        </tr>
                        @if($etudiant->classe)
                        <tr>
                            <td><strong>{{ __('app.classe') }}:</strong></td>
                            <td>{{ $etudiant->classe->nom_classe }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>{{ __('app.date_de_naissance') }}:</strong></td>
                            <td>{{ $etudiant->date_naissance ? $etudiant->date_naissance->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 text-end">
                    <div class="border rounded p-3">
                        <div class="h3 text-primary">{{ number_format($statistics['overall_average'], 2) }}/20</div>
                        <p class="mb-0">{{ __('app.moyenne_generale') }}</p>
                        <small class="text-muted">{{ $statistics['mention'] }}</small>
                    </div>
                </div>
            </div>

            <!-- Notes par matière -->
            @if($notesByMatiere->count() > 0)
                @foreach($notesByMatiere as $matiere => $matiereNotes)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">{{ $matiere }}</h6>
                            <span class="badge bg-primary">
                                {{ __('app.moyenne') }}: {{ number_format($statistics['averages'][$matiere]['average'], 2) }}/20
                            </span>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.date') }}</th>
                                        <th>{{ __('app.type') }}</th>
                                        <th>{{ __('app.note') }}</th>
                                        <th>{{ __('app.sur_20') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matiereNotes as $note)
                                        <tr>
                                            <td>{{ $note->evaluation?->date?->format('d/m/Y') ?? 'N/A' }}</td>
                                            <td>{{ ucfirst($note->evaluation?->type ?? 'N/A') }}</td>
                                            <td>{{ $note->note }}/{{ $note->evaluation?->note_max ?? 20 }}</td>
                                            <td>
                                                @php
                                                    $noteMax = $note->evaluation?->note_max ?? 20;
                                                    $noteSur20 = ($note->note / $noteMax) * 20;
                                                @endphp
                                                {{ number_format($noteSur20, 1) }}/20
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <!-- Résumé -->
                <div class="mt-4 border-top pt-3">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <strong>{{ number_format($statistics['overall_average'], 2) }}/20</strong>
                            <br><small class="text-muted">{{ __('app.moyenne_generale') }}</small>
                        </div>
                        <div class="col-md-4">
                            <strong>{{ $statistics['passed_notes'] }}/{{ $statistics['total_notes'] }}</strong>
                            <br><small class="text-muted">{{ __('app.notes_superieures') }}</small>
                        </div>
                        <div class="col-md-4">
                            <strong>{{ $statistics['mention'] }}</strong>
                            <br><small class="text-muted">{{ __('app.mention') }}</small>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">{{ __('app.aucune_note') }}</p>
                </div>
            @endif

            <!-- Simple Footer -->
            <div class="text-center mt-5 pt-3 border-top">
                <small class="text-muted">
                    {{ __('app.document_genere_le') }} {{ now()->format('d/m/Y à H:i') }}
                </small>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        font-size: 12px;
    }
    
    .table {
        font-size: 11px;
    }
    
    .table th, .table td {
        padding: 6px !important;
    }
}

.table th {
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
}
</style>

<script>
function changeYear() {
    const year = document.getElementById('yearSelect').value;
    const trimestre = document.getElementById('trimestreSelect').value;
    let url = `{{ route('rapports.notes.transcript', $etudiant->matricule) }}`;
    
    const params = new URLSearchParams();
    if (year) params.append('year', year);
    if (trimestre) url += `/${trimestre}`;
    
    if (params.toString()) {
        url += `?${params.toString()}`;
    }
    
    window.location.href = url;
}

function changeTrimestre() {
    const year = document.getElementById('yearSelect').value;
    const trimestre = document.getElementById('trimestreSelect').value;
    let url = `{{ route('rapports.notes.transcript', $etudiant->matricule) }}`;
    
    if (trimestre) {
        url += `/${trimestre}`;
    }
    
    const params = new URLSearchParams();
    if (year) params.append('year', year);
    
    if (params.toString()) {
        url += `?${params.toString()}`;
    }
    
    window.location.href = url;
}
</script>
@endsection