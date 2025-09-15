@extends('layouts.dashboard')

@section('title', __('app.ajouter_enseignant'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('enseignants.index') }}">{{ __('Enseignants') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        {{ __('Ajouter un nouvel enseignant') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enseignants.store') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <x-form.input 
                                name="nom" 
                                label="Nom" 
                                :value="old('nom')" 
                                required 
                                placeholder="Nom de famille" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="prenom" 
                                label="Prénom" 
                                :value="old('prenom')" 
                                required 
                                placeholder="Prénom" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="email" 
                                label="Email" 
                                type="email" 
                                :value="old('email')" 
                                required 
                                placeholder="exemple@ecole.com" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="telephone" 
                                label="Téléphone" 
                                type="tel" 
                                :value="old('telephone')" 
                                required 
                                placeholder="+222 XX XX XX XX" />
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe assignée" 
                                :value="old('id_classe')" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}">
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière enseignée" 
                                :value="old('matiere')" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques">Mathématiques</option>
                                <option value="Français">Français</option>
                                <option value="Anglais">Anglais</option>
                                <option value="Sciences Physiques">Sciences Physiques</option>
                                <option value="Biologie">Biologie</option>
                                <option value="Histoire-Géographie">Histoire-Géographie</option>
                                <option value="Arabe">اللغة العربية</option>
                                <option value="Education Islamique">التربية الإسلامية</option>
                                <option value="Education Civique">التربية المدنية</option>
                                <option value="Sport">التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Retour') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i>
                                    {{ __('Enregistrer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <script>
        const classeSelect = document.getElementById("id_classe");
        const matiereSelect = document.getElementById("matiere");

        function enableMatiereOptions() {
            matiereSelect.removeAttribute("disabled");
        }
        const matiereOptions = {
            1: ["اللغة العربية", "Calcule", "التربية الإسلامية"],
            2: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            3: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            4: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            5: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            6: ["Mathématiques","اللغة العربية", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            7: ["Mathématiques","Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            8: ["Mathématiques","Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            9: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            10: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            11: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "التربية المدنية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            12: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "التربية المدنية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            13: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            14: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
        };

        function updateMatiereOptions() {
            const selectedClasse = classeSelect.value;
            const matiereOptionsForClasse = matiereOptions[selectedClasse];

            matiereSelect.innerHTML = "";

            const defaultOption = document.createElement("option");
            defaultOption.text = "Choisir le matiere";
            defaultOption.value = '';
            defaultOption.disabled = true; // Set the disabled attribute
            defaultOption.selected = true; // Select the default option
            matiereSelect.appendChild(defaultOption);

            // Add new options to the matiere select
            matiereOptionsForClasse.forEach(matiere => {
                const option = document.createElement("option");
                option.text = matiere;
                matiereSelect.appendChild(option);

            });
            enableMatiereOptions();
        }

        // Listen for changes in the classe select and update matiere options
        classeSelect.addEventListener("change", updateMatiereOptions);

        // Initial update to set matiere options based on the default selected classe
        updateMatiereOptions();
    </script>
    <script src="{{ asset('js/regexEnse.js')}}"></script>
@endsection
