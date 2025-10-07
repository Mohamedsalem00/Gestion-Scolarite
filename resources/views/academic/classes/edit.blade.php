@extends('layouts.dashboard')

@section('title', __('app.modifier_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $classe->nom_classe }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.modifier_classe') }}: {{ $classe->nom_classe }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.update', $classe->id_classe) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input
                                    name="nom_classe"
                                    label="{{ __('app.nom_classe') }}"
                                    placeholder="{{ __('app.exemple_classe') }}"
                                    :value="old('nom_classe', $classe->nom_classe)"
                                    required="true"
                                    help="{{ __('app.aide_nom_classe') }}"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                                                <x-form.select
                                    name="niveau"
                                    label="{{ __('app.niveau') }}"
                                    :options="[
                                        'CP' => 'CP',
                                        'CE1' => 'CE1', 
                                        'CE2' => 'CE2',
                                        'CM1' => 'CM1',
                                        'CM2' => 'CM2'
                                    ]"
                                    :value="old('niveau', $classe->niveau)"
                            </div>
                        </div>
                        
                        <!-- Class Statistics -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6>{{ __('app.informations_classe') }}</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>{{ __('app.etudiants_inscrits') }}:</strong> {{ $classe->etudiants->count() }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ __('app.cours_assignes') }}:</strong> {{ $classe->cours->count() }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ __('app.creee_le') }}:</strong> {{ $classe->created_at?->format('d/m/Y') ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                        {{ __('app.annuler') }}
                                    </a>
                                    
                                    <div>
                                        <a href="{{ route('classes.show', $classe->id_classe) }}" class="btn btn-info me-2">
                                            {{ __('app.voir') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('app.enregistrer') }}
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
