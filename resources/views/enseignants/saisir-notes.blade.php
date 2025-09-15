@extends('layouts.dashboard')

@section('title', __('app.saisir_notes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.saisir_notes') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-clipboard-check text-primary"></i> {{ __('app.saisir_notes') }}
        </h1>
        @if($selectedClass)
            <div class="badge bg-info fs-6">
                <i class="fas fa-users me-1"></i> {{ $selectedClass->nom_classe }}
            </div>
        @endif
    </div>

    @if($teacherClasses->count() > 0)
        <!-- Class Selector -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <i class="fas fa-chalkboard text-primary me-2"></i>
                                <span class="fw-semibold">{{ __('app.choisir_classe') }}:</span>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach($teacherClasses as $classe)
                                    <a href="{{ request()->fullUrlWithQuery(['classe_id' => $classe->id_classe]) }}" 
                                       class="btn {{ $selectedClass && $selectedClass->id_classe == $classe->id_classe ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                                        <i class="fas fa-users me-1"></i>
                                        {{ $classe->nom_classe }}
                                        <span class="badge bg-light text-dark ms-1">{{ $classe->etudiants->count() }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($selectedClass)
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('app.total_etudiants') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $students->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('app.evaluations') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $evaluations->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('app.notes_saisies') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ \App\Models\Note::whereHas('etudiant', function($q) use ($selectedClass) { 
                                            $q->where('id_classe', $selectedClass->id_classe); 
                                        })->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('app.moyenne_classe') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @php
                                            $classAvg = \App\Models\Note::whereHas('etudiant', function($q) use ($selectedClass) { 
                                                $q->where('id_classe', $selectedClass->id_classe); 
                                            })->avg('note');
                                        @endphp
                                        {{ $classAvg ? number_format($classAvg, 1) : '--' }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calculator fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Students List -->
                <div class="col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-users me-2"></i>{{ __('app.etudiants') }} - {{ $selectedClass->nom_classe }}
                            </h6>
                            <div class="input-group" style="width: 200px;">
                                <input type="text" class="form-control form-control-sm" id="searchStudent" 
                                       placeholder="{{ __('app.rechercher') }}...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                            @if($students->count() > 0)
                                <div class="list-group list-group-flush" id="studentsList">
                                    @foreach($students as $student)
                                        <div class="list-group-item list-group-item-action border-0 student-item" 
                                             data-student="{{ strtolower($student->prenom . ' ' . $student->nom) }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-primary text-white me-3">
                                                        {{ strtoupper(substr($student->prenom, 0, 1) . substr($student->nom, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <strong class="d-block">{{ $student->prenom }} {{ $student->nom }}</strong>
                                                        <small class="text-muted">
                                                            <i class="fas fa-id-card me-1"></i>{{ $student->matricule }}
                                                        </small>
                                                        @php
                                                            $studentNotesCount = \App\Models\Note::where('id_etudiant', $student->id_etudiant)->count();
                                                            $studentAvg = \App\Models\Note::where('id_etudiant', $student->id_etudiant)->avg('note');
                                                        @endphp
                                                        <small class="d-block text-info">
                                                            <i class="fas fa-chart-bar me-1"></i>{{ $studentNotesCount }} {{ __('app.notes') }}
                                                            @if($studentAvg)
                                                                | Moy: {{ number_format($studentAvg, 1) }}
                                                            @endif
                                                        </small>
                                        @if(isset($existingNotes[$student->id_etudiant]) && $existingNotes[$student->id_etudiant]->count() > 0)
                                            <div class="mt-2">
                                                <small class="text-success fw-bold">
                                                    <i class="fas fa-check-circle me-1"></i>{{ __('app.notes_existantes') }}:
                                                </small>
                                                @foreach($existingNotes[$student->id_etudiant] as $note)
                                                    <div class="badge bg-light text-dark border me-1 mt-1">
                                                        {{ $note->evaluation->matiere_relation ? $note->evaluation->matiere_relation->nom_matiere : $note->evaluation->matiere }}: {{ $note->note }}/{{ $note->evaluation->note_max }}
                                                        <button type="button" class="btn-close btn-close-sm ms-1" 
                                                                onclick="editNote({{ $note->id_note }}, {{ $student->id_etudiant }}, '{{ $student->prenom }} {{ $student->nom }}', {{ $note->id_evaluation }}, {{ $note->note }})" 
                                                                title="{{ __('app.modifier') }}"></button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary" 
                                                        onclick="selectStudent({{ $student->id_etudiant }}, '{{ $student->prenom }} {{ $student->nom }}', '{{ $student->matricule }}')">
                                                    <i class="fas fa-plus"></i> {{ __('app.noter') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ __('app.aucun_etudiant_trouve') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Grade Entry Form -->
                <div class="col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">
                                <i class="fas fa-edit me-2"></i>{{ __('app.formulaire_saisie_notes') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <form id="gradeForm" method="POST" action="{{ route('notes.store') }}">
                                @csrf
                                <input type="hidden" name="from_saisir_notes" value="1">
                                <input type="hidden" name="from_saisir_notes" value="1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="student_name" class="form-label fw-bold">
                                                <i class="fas fa-user text-primary me-1"></i>{{ __('app.etudiant_selectionne') }}
                                            </label>
                                            <input type="text" class="form-control form-control-lg" id="student_name" readonly 
                                                   placeholder="{{ __('app.selectionnez_un_etudiant') }}">
                                            <input type="hidden" id="student_id" name="id_etudiant">
                                            <input type="hidden" id="student_matricule" name="student_matricule">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="evaluation_id" class="form-label fw-bold">
                                                <i class="fas fa-clipboard-check text-info me-1"></i>{{ __('app.evaluation') }}
                                            </label>
                                            <select class="form-control form-control-lg" id="evaluation_id" name="id_evaluation" required onchange="updateEvaluationFields()">
                                                <option value="">{{ __('app.choisir_evaluation') }}</option>
                                                @foreach($evaluations as $evaluation)
                                                    <option value="{{ $evaluation->id_evaluation }}" 
                                                            data-matiere="{{ $evaluation->matiere_relation ? $evaluation->matiere_relation->nom_matiere : $evaluation->matiere }}" 
                                                            data-type="{{ $evaluation->type }}"
                                                            data-note-max="{{ $evaluation->note_max }}">
                                                        {{ $evaluation->matiere_relation ? $evaluation->matiere_relation->nom_matiere : $evaluation->matiere }} - {{ ucfirst($evaluation->type) }} ({{ $evaluation->note_max }} pts)
                                                        @if($evaluation->date)
                                                            ({{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="matiere" name="matiere">
                                            <input type="hidden" id="type" name="type">
                                            <input type="hidden" name="id_classe" value="{{ $selectedClass->id_classe }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="note_obtenue" class="form-label fw-bold">
                                                <i class="fas fa-trophy text-warning me-1"></i>{{ __('app.note_obtenue') }}
                                            </label>
                                            <input type="number" class="form-control form-control-lg text-center" id="note_obtenue" 
                                                   name="note" step="0.01" min="0" required>
                                            <input type="hidden" id="note_final" name="note">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="note_totale" class="form-label fw-bold">
                                                <i class="fas fa-bullseye text-danger me-1"></i>{{ __('app.note_totale') }}
                                            </label>
                                            <input type="number" class="form-control form-control-lg text-center" id="note_totale" 
                                                   name="note_totale" step="0.01" min="0" value="20" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-percent text-success me-1"></i>{{ __('app.pourcentage') }}
                                            </label>
                                            <div class="form-control form-control-lg text-center bg-light" id="percentage">--</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="commentaire" class="form-label fw-bold">
                                        <i class="fas fa-comment text-secondary me-1"></i>{{ __('app.commentaire') }} 
                                        <small class="text-muted">({{ __('app.optionnel') }})</small>
                                    </label>
                                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3" 
                                              placeholder="{{ __('app.commentaire_placeholder') }}"></textarea>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                        <i class="fas fa-undo me-1"></i>{{ __('app.reinitialiser') }}
                                    </button>
                                    <button type="submit" class="btn btn-success btn-lg" disabled id="submitBtn">
                                        <i class="fas fa-save me-2"></i>{{ __('app.enregistrer_note') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Notes for Selected Student -->
                    <div class="card shadow" id="recentNotesCard" style="display: none;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-info">
                                <i class="fas fa-history me-2"></i>{{ __('app.notes_recentes') }}
                            </h6>
                        </div>
                        <div class="card-body" id="recentNotesContent">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-info-circle fa-3x mb-3 text-muted"></i>
                <h4>{{ __('app.selectionner_classe') }}</h4>
                <p class="mb-0">{{ __('app.veuillez_selectionner_une_classe') }}</p>
            </div>
        @endif
    @else
        <div class="alert alert-warning text-center py-5">
            <i class="fas fa-exclamation-triangle fa-3x mb-3 text-muted"></i>
            <h4>{{ __('app.aucune_classe_assignee') }}</h4>
            <p class="mb-0">{{ __('app.contactez_administrateur') }}</p>
        </div>
    @endif
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}
.student-item:hover {
    background-color: #f8f9fa;
}
</style>

<script>
let selectedStudentId = null;
let selectedStudentName = null;

function selectStudent(studentId, studentName, matricule) {
    selectedStudentId = studentId;
    selectedStudentName = studentName;
    
    document.getElementById('student_id').value = studentId;
    document.getElementById('student_name').value = studentName;
    document.getElementById('student_matricule').value = matricule;
    document.getElementById('submitBtn').disabled = false;
    
    // Load recent notes for this student
    loadRecentNotes(studentId);
    
    // Highlight selected student
    document.querySelectorAll('.student-item').forEach(item => {
        item.classList.remove('bg-light', 'border-primary');
    });
    
    event.target.closest('.student-item').classList.add('bg-light', 'border-primary');
}

function resetForm() {
    document.getElementById('gradeForm').reset();
    document.getElementById('student_name').value = '';
    document.getElementById('student_id').value = '';
    document.getElementById('student_matricule').value = '';
    document.getElementById('note_final').value = '';
    document.getElementById('matiere').value = '';
    document.getElementById('type').value = '';
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('percentage').textContent = '--';
    document.getElementById('recentNotesCard').style.display = 'none';
    
    // Remove highlight from students
    document.querySelectorAll('.student-item').forEach(item => {
        item.classList.remove('bg-light', 'border-primary');
    });
    
    selectedStudentId = null;
    selectedStudentName = null;
}

function updateEvaluationFields() {
    const select = document.getElementById('evaluation_id');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption && selectedOption.value) {
        document.getElementById('matiere').value = selectedOption.getAttribute('data-matiere') || '';
        document.getElementById('type').value = selectedOption.getAttribute('data-type') || '';
        const noteMax = selectedOption.getAttribute('data-note-max') || '20';
        document.getElementById('note_totale').value = noteMax;
        
        // Update the max attribute for the note input
        document.getElementById('note_obtenue').setAttribute('max', noteMax);
        
        // Recalculate percentage if there's already a note
        calculatePercentage();
    } else {
        document.getElementById('matiere').value = '';
        document.getElementById('type').value = '';
        document.getElementById('note_totale').value = '';
        document.getElementById('note_obtenue').removeAttribute('max');
    }
}

function calculatePercentage() {
    const noteObtenue = parseFloat(document.getElementById('note_obtenue').value) || 0;
    const noteTotale = parseFloat(document.getElementById('note_totale').value) || 0;
    
    if (noteTotale > 0) {
        const percentage = (noteObtenue / noteTotale * 100).toFixed(1);
        document.getElementById('percentage').textContent = percentage + '%';
        
        // Calculate final grade out of 20 (standard French grading system)
        const finalGrade = (noteObtenue / noteTotale * 20).toFixed(2);
        document.getElementById('note_final').value = finalGrade;
        
        // Color coding
        const percentageEl = document.getElementById('percentage');
        percentageEl.classList.remove('text-danger', 'text-warning', 'text-success');
        
        if (percentage >= 70) percentageEl.classList.add('text-success');
        else if (percentage >= 50) percentageEl.classList.add('text-warning');
        else percentageEl.classList.add('text-danger');
    } else {
        document.getElementById('percentage').textContent = '--';
        document.getElementById('note_final').value = '';
    }
}

function loadRecentNotes(studentId) {
    // Show the recent notes card
    document.getElementById('recentNotesCard').style.display = 'block';
    document.getElementById('recentNotesContent').innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> {{ __("app.chargement") }}...</div>';
    
    // You can implement AJAX call here to load recent notes
    // For now, we'll show a placeholder
    setTimeout(() => {
        document.getElementById('recentNotesContent').innerHTML = `
            <div class="text-muted text-center">
                <i class="fas fa-chart-line"></i> {{ __("app.notes_precedentes_etudiant") }}
                <br><small>{{ __("app.fonctionnalite_bientot_disponible") }}</small>
            </div>
        `;
    }, 1000);
}

// Search functionality
document.getElementById('searchStudent').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const students = document.querySelectorAll('.student-item');
    
    students.forEach(student => {
        const studentName = student.getAttribute('data-student');
        if (studentName.includes(searchTerm)) {
            student.style.display = 'block';
        } else {
            student.style.display = 'none';
        }
    });
});

// Auto-calculate percentage
document.getElementById('note_obtenue').addEventListener('input', calculatePercentage);
document.getElementById('note_totale').addEventListener('input', calculatePercentage);

// Form validation
document.getElementById('gradeForm').addEventListener('submit', function(e) {
    const noteObtenue = parseFloat(document.getElementById('note_obtenue').value);
    const noteTotale = parseFloat(document.getElementById('note_totale').value);
    
    if (noteObtenue > noteTotale) {
        e.preventDefault();
        alert('{{ __("app.note_obtenue_superieure_totale") }}');
        return false;
    }
    
    if (!selectedStudentId) {
        e.preventDefault();
        alert('{{ __("app.veuillez_selectionner_etudiant") }}');
        return false;
    }
});

// Edit existing note function
function editNote(noteId, studentId, studentName, evaluationId, currentNote) {
    // Select the student
    selectStudent(studentId, studentName, '');
    
    // Set the evaluation
    document.getElementById('evaluation_id').value = evaluationId;
    updateEvaluationFields();
    
    // Set the current note value
    document.getElementById('note_obtenue').value = currentNote;
    
    // Update form to edit mode
    const form = document.getElementById('gradeForm');
    form.action = "{{ route('notes.update', '') }}/" + noteId;
    
    // Add method field for PUT request
    let methodField = document.getElementById('_method');
    if (!methodField) {
        methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.id = '_method';
        form.appendChild(methodField);
    }
    methodField.value = 'PUT';
    
    // Update submit button text
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>{{ __("app.modifier_note") }}';
    submitBtn.classList.remove('btn-success');
    submitBtn.classList.add('btn-warning');
    
    // Add cancel button if not exists
    let cancelBtn = document.getElementById('cancelBtn');
    if (!cancelBtn) {
        cancelBtn = document.createElement('button');
        cancelBtn.type = 'button';
        cancelBtn.id = 'cancelBtn';
        cancelBtn.className = 'btn btn-secondary me-2';
        cancelBtn.innerHTML = '<i class="fas fa-times me-1"></i>{{ __("app.annuler") }}';
        cancelBtn.onclick = cancelEdit;
        submitBtn.parentNode.insertBefore(cancelBtn, submitBtn);
    }
    
    // Calculate percentage
    calculatePercentage();
    
    // Scroll to form
    document.getElementById('gradeForm').scrollIntoView({ behavior: 'smooth' });
}

// Cancel edit function
function cancelEdit() {
    // Reset form action
    document.getElementById('gradeForm').action = "{{ route('notes.store') }}";
    
    // Remove method field
    const methodField = document.getElementById('_method');
    if (methodField) {
        methodField.remove();
    }
    
    // Reset submit button
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>{{ __("app.enregistrer_note") }}';
    submitBtn.classList.remove('btn-warning');
    submitBtn.classList.add('btn-success');
    
    // Remove cancel button
    const cancelBtn = document.getElementById('cancelBtn');
    if (cancelBtn) {
        cancelBtn.remove();
    }
    
    // Reset form
    resetForm();
}
</script>
@endsection
