@extends('layouts.dashboard')

@section('title', __('app.modifier_enseignant'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('enseignants.index') }}">{{ __('Enseignants') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil me-2"></i>
                        {{ __('Modifier l\'enseignant') }} - {{ $enseignant->prenom }} {{ $enseignant->nom }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enseignants.update', $enseignant->id_enseignant) }}" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <x-form.input 
                                name="nom" 
                                label="Nom" 
                                :value="old('nom', $enseignant->nom)" 
                                required 
                                placeholder="Nom de famille" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="prenom" 
                                label="Prénom" 
                                :value="old('prenom', $enseignant->prenom)" 
                                required 
                                placeholder="Prénom" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="email" 
                                label="Email" 
                                type="email" 
                                :value="old('email', $enseignant->email)" 
                                required 
                                placeholder="exemple@ecole.com" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="telephone" 
                                label="Téléphone" 
                                type="tel" 
                                :value="old('telephone', $enseignant->telephone)" 
                                required 
                                placeholder="+222 XX XX XX XX" />
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe assignée" 
                                :value="old('id_classe', $enseignant->id_classe)" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" 
                                            {{ old('id_classe', $enseignant->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière enseignée" 
                                :value="old('matiere', $enseignant->matiere)" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques" {{ old('matiere', $enseignant->matiere) == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Français" {{ old('matiere', $enseignant->matiere) == 'Français' ? 'selected' : '' }}>Français</option>
                                <option value="Anglais" {{ old('matiere', $enseignant->matiere) == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                                <option value="Sciences Physiques" {{ old('matiere', $enseignant->matiere) == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                                <option value="Biologie" {{ old('matiere', $enseignant->matiere) == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                                <option value="Histoire-Géographie" {{ old('matiere', $enseignant->matiere) == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                                <option value="اللغة العربية" {{ old('matiere', $enseignant->matiere) == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                                <option value="التربية الإسلامية" {{ old('matiere', $enseignant->matiere) == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                                <option value="التربية المدنية" {{ old('matiere', $enseignant->matiere) == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                                <option value="التربية البدنية" {{ old('matiere', $enseignant->matiere) == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Retour') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i>
                                    {{ __('Mettre à jour') }}
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
            6: ["Mathématiques", "اللغة العربية", "Français", "Sciences naturelles", "التربية الإسلامية",
                "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            7: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            8: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            9: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            10: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            11: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "التربية المدنية", "اللغة العربية",
                "Physique Chimie", "Sciences naturelles"
            ],
            12: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "التربية المدنية", "اللغة العربية",
                "Physique Chimie", "Sciences naturelles"
            ],
            13: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles"
            ],
            14: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie",
                "Sciences naturelles"
            ],
        };

        // Function to update the matiere select options
        function updateMatiereOptions() {
            const selectedClasse = classeSelect.value;
            const matiereOptionsForClasse = matiereOptions[selectedClasse];

            // Clear the matiere select options
            matiereSelect.innerHTML = "";

            const defaultOption = document.createElement("option");
            defaultOption.text = "select matiere";
            matiereSelect.appendChild(defaultOption);

            // Add new options to the matiere select
            matiereOptionsForClasse.forEach(matiere => {
                const option = document.createElement("option");
                option.text = matiere;
                matiereSelect.appendChild(option);
                defaultOption.remove();
            });
            enableMatiereOptions();
        }

        // Listen for changes in the classe select and update matiere options
        classeSelect.addEventListener("change", updateMatiereOptions);

        // Initial update to set matiere options based on the default selected classe
        updateMatiereOptions();

        document.addEventListener('DOMContentLoaded', () => {
            const matiereSelect = document.getElementById("matiere");
            const selectedMatiereValue =
                "{{ $enseignant->matiere }}"; // Assuming you pass the selected matiere value to the view

            // Find the option with the selected matiere value and set it as selected
            const selectedOption = Array.from(matiereSelect.options).find(option => option.value ===
                selectedMatiereValue);
            if (selectedOption) {
                selectedOption.selected = true;
            }
        });
    </script>
    <script src="{{ asset('js/regexEnse.js') }}"></script>
@endsection
