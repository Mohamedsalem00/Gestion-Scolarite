@extends('layouts.dashboard')

@section('title', __('app.modifier_note'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">{{ __('app.notes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-4">{{ __('app.modifier_note') }}</h5>
                    
                    <!-- Student Info -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ __('app.etudiant') }}:</strong> {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('app.classe') }}:</strong> {{ $note->classe->nom_classe }}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <strong>{{ __('app.evaluation') }}:</strong> {{ $note->evaluation->titre ?? ucfirst($note->evaluation->type) }}
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('app.note_max') }}:</strong> {{ $note->evaluation->note_max }}
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('notes.update', $note) }}" method="POST" id="noteForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Note Field -->
                        <div class="mb-3">
                            <label for="note" class="form-label">
                                {{ __('app.note') }} <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control @error('note') is-invalid @enderror" 
                                       id="note" 
                                       name="note" 
                                       value="{{ old('note', $note->note) }}" 
                                       min="0" 
                                       max="{{ $note->evaluation->note_max }}"
                                       step="0.25"
                                       required>
                                <span class="input-group-text">/ {{ $note->evaluation->note_max }}</span>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Live Preview -->
                            <div class="mt-2 p-2 bg-light rounded small" id="notePreview">
                                <span id="percentageDisplay">-</span> - 
                                <span id="appreciationBadge">-</span>
                            </div>
                        </div>
                        
                        <!-- Quick Note Buttons -->
                        <div class="mb-4">
                            <label class="form-label small text-muted">Saisie Rapide</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary quick-note" data-value="0">0</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary quick-note" data-value="{{ $note->evaluation->note_max * 0.5 }}">{{ $note->evaluation->note_max * 0.5 }}</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary quick-note" data-value="{{ $note->evaluation->note_max }}">{{ $note->evaluation->note_max }}</button>
                            </div>
                        </div>
                        
                        <!-- Comment Field -->
                        <div class="mb-4">
                            <label for="commentaire" class="form-label">{{ __('app.commentaire') }}</label>
                            <textarea class="form-control @error('commentaire') is-invalid @enderror" 
                                      id="commentaire" 
                                      name="commentaire" 
                                      rows="3"
                                      placeholder="Commentaire...">{{ old('commentaire', $note->commentaire) }}</textarea>
                            @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                {{ __('app.annuler') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('app.enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const noteInput = document.getElementById('note');
    const noteMax = {{ $note->evaluation->note_max }};
    
    // Update preview when note changes
    function updatePreview() {
        const noteValue = parseFloat(noteInput.value) || 0;
        const percentage = (noteValue / noteMax) * 100;
        
        // Update percentage
        document.getElementById('percentageDisplay').textContent = Math.round(percentage) + '%';
        
        // Update appreciation
        let appreciation;
        if (percentage >= 80) appreciation = 'Excellent';
        else if (percentage >= 60) appreciation = 'Bien';
        else if (percentage >= 50) appreciation = 'Passable';
        else appreciation = 'Insuffisant';
        
        document.getElementById('appreciationBadge').textContent = appreciation;
    }
    
    // Event listeners
    noteInput.addEventListener('input', updatePreview);
    
    // Quick note buttons
    document.querySelectorAll('.quick-note').forEach(button => {
        button.addEventListener('click', function() {
            noteInput.value = this.dataset.value;
            updatePreview();
        });
    });
    
    // Initial preview
    updatePreview();
    
    // Form validation
    document.getElementById('noteForm').addEventListener('submit', function(e) {
        const noteValue = parseFloat(noteInput.value);
        
        if (noteValue < 0 || noteValue > noteMax) {
            e.preventDefault();
            alert(`La note doit être entre 0 et ${noteMax}`);
            noteInput.focus();
        }
    });
});
</script>
@endpush
