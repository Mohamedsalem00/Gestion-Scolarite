@extends('layouts.dashboard')

@section('title', __('app.modifier_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $enseignant->prenom }} {{ $enseignant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    <a href="{{ route('enseignants.show', $enseignant->id_enseignant) }}" class="btn btn-outline-primary">
        {{ __('app.voir') }}
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.modifier_enseignant') }}: {{ $enseignant->prenom }} {{ $enseignant->nom }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enseignants.update', $enseignant->id_enseignant) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">{{ __('app.nom') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" name="nom" value="{{ old('nom', $enseignant->nom) }}" required 
                                           placeholder="{{ __('app.nom_famille') }}">
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">{{ __('app.prenom') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                           id="prenom" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required 
                                           placeholder="{{ __('app.prenom') }}">
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('app.email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $enseignant->email) }}" required 
                                           placeholder="exemple@ecole.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">{{ __('app.telephone') }} <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                           id="telephone" name="telephone" value="{{ old('telephone', $enseignant->telephone) }}" required 
                                           placeholder="+222 XX XX XX XX">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_classe" class="form-label">{{ __('app.classe_assignee') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_classe') is-invalid @enderror" 
                                            id="id_classe" name="id_classe" required>
                                        <option value="">{{ __('app.selectionner_classe') }}</option>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id_classe }}" {{ old('id_classe', $enseignant->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                                {{ $classe->nom_classe }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_classe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="matiere" class="form-label">{{ __('app.matiere_enseignee') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('matiere') is-invalid @enderror" 
                                            id="matiere" name="matiere" required>
                                        <option value="">{{ __('app.selectionner_matiere') }}</option>
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
                                    </select>
                                    @error('matiere')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
                                {{ __('app.annuler') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('app.sauvegarder') }}
                            </button>
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
