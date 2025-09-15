@extends('layouts.dashboard')

@section('title', __('app.edit') . ' ' . __('app.class'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.academic_management') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.edit') }} - {{ $Classe->nom_classe }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier la Classe: {{ $Classe->nom_classe }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.update', $Classe->id_classe) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input
                                    name="nom_classe"
                                    label="Nom de la Classe"
                                    placeholder="Ex: 6ème A, CM2 B..."
                                    :value="old('nom_classe', $Classe->nom_classe)"
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
                                    :value="old('niveau', $Classe->niveau)"
                                    required="true"
                                    min="1"
                                    max="12"
                                    help="Niveau de la classe (1-12)"
                                />
                            </div>
                        </div>
                        
                        <!-- Class Statistics -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Informations de la Classe</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Étudiants inscrits:</strong> {{ $Classe->etudiants->count() }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Cours assignés:</strong> {{ $Classe->cours->count() }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Créée le:</strong> {{ $Classe->created_at?->format('d/m/Y') ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        {{ __('app.cancel') }}
                                    </a>
                                    
                                    <div>
                                        <a href="{{ route('classes.show', $Classe->id_classe) }}" class="btn btn-info me-2">
                                            <i class="fas fa-eye me-2"></i>
                                            {{ __('app.view') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            {{ __('app.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
