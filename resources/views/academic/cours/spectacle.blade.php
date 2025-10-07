@extends('layouts.dashboard')

@section('title', __('app.emploi_du_temps'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.emploi_du_temps') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('cours.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                {{ __('app.ajouter_cours') }}
            </a>
        @endadmin
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ __('app.emploi_du_temps') }}</h4>
            <p class="text-muted small mb-0">{{ __('app.consulter_emploi_temps') }}</p>
        </div>
        <div style="min-width: 250px;">
            <select id="classeSelect" class="form-select">
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id_classe }}" {{ request('classe') == $classe->id_classe ? 'selected' : '' }}>
                        {{ $classe->nom_classe }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Timetable Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive" id="timetableContainer">
                <table class="table mb-0 timetable-custom">
                    <thead>
                        <tr>
                            <th class="time-column">{{ __('app.horaire') }}</th>
                            <th>{{ __('app.lundi') }}</th>
                            <th>{{ __('app.mardi') }}</th>
                            <th>{{ __('app.mercredi') }}</th>
                            <th>{{ __('app.jeudi') }}</th>
                            <th>{{ __('app.vendredi') }}</th>
                        </tr>
                    </thead>
                    <tbody id="scheduleTableBody">
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-5" style="display: none;">
                <i class="bi bi-calendar-x text-muted mb-3" style="font-size: 3rem;"></i>
                <h5 class="text-muted mb-2">{{ __('app.aucun_cours_trouve') }}</h5>
                <p class="text-muted small">{{ __('app.aucun_cours_pour_cette_classe') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Timetable Custom Styles */
.timetable-custom {
    border-collapse: separate;
    border-spacing: 0;
}

.timetable-custom thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.timetable-custom thead th {
    color: white;
    font-weight: 600;
    padding: 1rem;
    border: none;
    text-align: center;
    vertical-align: middle;
    font-size: 0.95rem;
}

.time-column {
    width: 120px;
}

.timetable-custom tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border: 1px solid #dee2e6;
    text-align: center;
}

.timetable-custom tbody td:first-child {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
}

.timetable-custom tbody tr:hover td:first-child {
    background-color: #e9ecef;
}

.timetable-custom tbody td:not(:first-child) {
    background: white;
    transition: background-color 0.2s ease;
}

.timetable-custom tbody td:not(:first-child):hover {
    background-color: #f8f9fa;
}

.timetable-custom tbody tr:nth-child(even) td:not(:first-child) {
    background: #fafbfc;
}

/* Course Cell */
.course-cell {
    display: block;
    padding: 0.85rem 1rem;
    background: #f8f9fa;
    border: 2px solid #667eea;
    color: #2d3748;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
}

.course-cell:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
    background: #ffffff;
    border-color: #764ba2;
    color: #2d3748;
    text-decoration: none;
}

.course-matiere {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 0.4rem;
    color: #667eea;
}

.course-enseignant {
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 500;
}

.empty-cell {
    color: #cbd5e0;
    font-size: 1.5rem;
}

/* Empty Cell Clickable (for admins) */
.empty-cell-clickable {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    color: #9ca3af;
    text-decoration: none;
    border: 2px dashed #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s ease;
    min-height: 80px;
}

.empty-cell-clickable:hover {
    color: #667eea;
    border-color: #667eea;
    background: #f0f4ff;
    text-decoration: none;
    transform: scale(1.02);
}

.empty-cell-clickable i {
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
}

.empty-cell-clickable small {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Responsive */
@media (max-width: 768px) {
    .timetable-custom thead th {
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
    }
    
    .timetable-custom tbody td {
        padding: 1rem 0.5rem;
    }
    
    .course-cell {
        padding: 0.6rem 0.75rem;
    }
    
    .course-matiere {
        font-size: 0.85rem;
    }
    
    .course-enseignant {
        font-size: 0.75rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
    const scheduleData = @json($schedule);
    const timeSlots = @json($timeSlots);
    const jours = @json($jours);
    const isAdmin = @json(auth()->user()->role === 'admin');

    function renderSchedule(classeId) {
        const tbody = document.getElementById('scheduleTableBody');
        const emptyState = document.getElementById('emptyState');
        const table = document.getElementById('timetableContainer');

        tbody.innerHTML = '';

        if (!scheduleData[classeId] || Object.keys(scheduleData[classeId]).length === 0) {
            table.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }

        table.style.display = 'block';
        emptyState.style.display = 'none';

        timeSlots.forEach(slot => {
            const timeSlotKey = slot.debut + '-' + slot.fin;
            const courses = scheduleData[classeId][timeSlotKey] || {};
            
            const row = document.createElement('tr');

            const timeCell = document.createElement('td');
            timeCell.innerHTML = '<strong>' + slot.debut + '</strong><br><small class="text-muted">-</small><br><strong>' + slot.fin + '</strong>';
            row.appendChild(timeCell);

            jours.forEach(jour => {
                const cell = document.createElement('td');

                const course = courses[jour];

                if (course) {
                    const link = document.createElement('a');
                    link.href = '/cours/' + course.id_cours + '/edit?from_timetable=1&id_classe=' + classeId + 
                                '&date_debut=' + encodeURIComponent(slot.debut) + 
                                '&date_fin=' + encodeURIComponent(slot.fin) + 
                                '&jour=' + jour;
                    link.className = 'course-cell';

                    const matiereDiv = document.createElement('div');
                    matiereDiv.className = 'course-matiere';
                    matiereDiv.textContent = course.matiere ? course.matiere.code_matiere : 'N/A';

                    const enseignantDiv = document.createElement('div');
                    enseignantDiv.className = 'course-enseignant';
                    enseignantDiv.textContent = course.enseignant 
                        ? course.enseignant.prenom + ' ' + course.enseignant.nom
                        : '{{ __("app.non_assigne") }}';

                    link.appendChild(matiereDiv);
                    link.appendChild(enseignantDiv);
                    cell.appendChild(link);
                } else {
                    // Empty cell
                    if (isAdmin) {
                        const addLink = document.createElement('a');
                        addLink.href = '#';
                        addLink.className = 'empty-cell-clickable';
                        addLink.innerHTML = '<i class="bi bi-plus-circle"></i><br><small>Ajouter</small>';
                        addLink.onclick = function(e) {
                            e.preventDefault();
                            addCourse(classeId, slot.debut, slot.fin, jour);
                        };
                        cell.appendChild(addLink);
                    } else {
                        const emptySpan = document.createElement('span');
                        emptySpan.className = 'empty-cell';
                        emptySpan.textContent = '—';
                        cell.appendChild(emptySpan);
                    }
                }

                row.appendChild(cell);
            });

            tbody.appendChild(row);
        });
    }

    function addCourse(classeId, dateDebut, dateFin, jour) {
        // Build URL with pre-filled data
        const url = new URL('{{ route("cours.create") }}', window.location.origin);
        url.searchParams.append('from_timetable', '1');
        url.searchParams.append('id_classe', classeId);
        url.searchParams.append('date_debut', dateDebut + ':00');
        url.searchParams.append('date_fin', dateFin + ':00');
        url.searchParams.append('jour', jour);
        
        window.location.href = url.toString();
    }

    const classeSelect = document.getElementById('classeSelect');
    classeSelect.addEventListener('change', function() {
        renderSchedule(this.value);
    });

    if (classeSelect.value) {
        renderSchedule(classeSelect.value);
    }
</script>
@endpush
