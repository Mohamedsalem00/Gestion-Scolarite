@extends('layouts.dashboard')

@section('title', __('app.create') . ' ' . __('app.class'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.academic_management') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.create') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Créer une Nouvelle Classe
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input
                                    name="nom_classe"
                                    label="Nom de la Classe"
                                    placeholder="Ex: 6ème A, CM2 B..."
                                    :value="old('nom_classe')"
                                    required="true"
                                    help="Nom de la classe (ex: 6ème A, CM2 B)"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-form.input
                                    name="niveau"
                                    label="Niveau"
                                    type="number"
                                    placeholder="1, 2, 3..."
                                    :value="old('niveau')"
                                    required="true"
                                    min="1"
                                    max="12"
                                    help="Niveau de la classe (1-12)"
                                />
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        {{ __('app.cancel') }}
                                    </a>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>
                                        {{ __('app.create') }}
                                    </button>
                                </div>
                            </div>
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
    // Auto-focus first input
    const firstInput = document.querySelector('input[name="nom_classe"]');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>
@endpush
