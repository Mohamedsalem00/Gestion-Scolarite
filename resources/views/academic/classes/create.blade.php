@extends('layouts.dashboard')

@section('title', __('app.creer_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.creer') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.creer_nouvelle_classe') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input
                                    name="nom_classe"
                                    label="{{ __('app.nom_classe') }}"
                                    placeholder="{{ __('app.exemple_classe') }}"
                                    :value="old('nom_classe')"
                                    required="true"
                                    help="{{ __('app.aide_nom_classe') }}"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-form.input
                                    name="niveau"
                                    label="{{ __('app.niveau') }}"
                                    type="number"
                                    placeholder="1, 2, 3..."
                                    :value="old('niveau')"
                                    required="true"
                                    min="1"
                                    max="12"
                                    help="{{ __('app.aide_niveau_classe') }}"
                                />
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                        {{ __('app.annuler') }}
                                    </a>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.creer_classe') }}
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
