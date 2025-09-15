@extends('layouts.dashboard')

@section('title', __('app.modifier_cours'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('cours.index') }}">{{ __('Cours') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Formulaire de modification -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        {{ __('Modifier le cours') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cours.update', $Cours->id_cours) }}" class="row g-3">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_classe" 
                                label="Classe" 
                                :value="old('id_classe', $Cours->id_classe)" 
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ $Cours->id_classe == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="id_enseignant" 
                                label="Enseignant" 
                                :value="old('id_enseignant', $Cours->id_enseignant)" 
                                required>
                                <option value="">{{ __('Sélectionner un enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" {{ $Cours->id_enseignant == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }} - {{ $enseignant->matiere }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="matiere" 
                                label="Matière" 
                                :value="old('matiere', $Cours->matiere)" 
                                required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques" {{ $Cours->matiere == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Français" {{ $Cours->matiere == 'Français' ? 'selected' : '' }}>Français</option>
                                <option value="Anglais" {{ $Cours->matiere == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                                <option value="Sciences Physiques" {{ $Cours->matiere == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                                <option value="Biologie" {{ $Cours->matiere == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                                <option value="Histoire-Géographie" {{ $Cours->matiere == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                                <option value="اللغة العربية" {{ $Cours->matiere == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                                <option value="التربية الإسلامية" {{ $Cours->matiere == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                                <option value="التربية المدنية" {{ $Cours->matiere == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                                <option value="التربية البدنية" {{ $Cours->matiere == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.select 
                                name="jour" 
                                label="Jour de la semaine" 
                                :value="old('jour', $Cours->jour)" 
                                required>
                                <option value="">{{ __('Sélectionner un jour') }}</option>
                                <option value="lundi" {{ strtolower($Cours->jour) == 'lundi' ? 'selected' : '' }}>{{ __('Lundi') }}</option>
                                <option value="mardi" {{ strtolower($Cours->jour) == 'mardi' ? 'selected' : '' }}>{{ __('Mardi') }}</option>
                                <option value="mercredi" {{ strtolower($Cours->jour) == 'mercredi' ? 'selected' : '' }}>{{ __('Mercredi') }}</option>
                                <option value="jeudi" {{ strtolower($Cours->jour) == 'jeudi' ? 'selected' : '' }}>{{ __('Jeudi') }}</option>
                                <option value="vendredi" {{ strtolower($Cours->jour) == 'vendredi' ? 'selected' : '' }}>{{ __('Vendredi') }}</option>
                            </x-form.select>
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_debut" 
                                label="Heure de début" 
                                type="time" 
                                :value="old('date_debut', $Cours->date_debut)" 
                                required />
                        </div>

                        <div class="col-md-6">
                            <x-form.input 
                                name="date_fin" 
                                label="Heure de fin" 
                                type="time" 
                                :value="old('date_fin', $Cours->date_fin)" 
                                required />
                        </div>

                        <div class="col-12">
                            <x-form.textarea 
                                name="description" 
                                label="Description (optionnel)" 
                                :value="old('description', $Cours->description ?? '')" 
                                rows="3"
                                placeholder="Description du cours ou notes particulières..." />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('Supprimer') }}
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('cours.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i>
                                        {{ __('Retour') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-1"></i>
                                        {{ __('Mettre à jour') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Confirmer la suppression') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Êtes-vous sûr de vouloir supprimer ce cours ?') }}</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Cette action est irréversible.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <form method="POST" action="{{ route('cours.destroy', $Cours->id_cours) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('Supprimer définitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
                                    </option>
                                    <option value="10:00:00" {{ $Cours->date_debut == '10:00:00' ? 'selected' : '' }}>10:00
                                    </option>
                                    <option value="11:15:00" {{ $Cours->date_debut == '11:15:00' ? 'selected' : '' }}>11:15
                                    </option>
                                    <option value="12:00:00" {{ $Cours->date_debut == '12:00:00' ? 'selected' : '' }}>12:00
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_fin" class="form-label">Heure de fin:</label>
                                <select id="date_fin" name="date_fin" class="form-control" required>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputMatiere" class="form-label">Matiere</label>
                                <select id="matiere" name="matiere" class="form-select">

                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Enregistrer</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
                $('.show-alert-delete-box').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    swal({
                        title: "Voulez-vous vraiment supprimer cet enregistrement ?",
                        text: "Si vous le supprimez, il disparaîtra pour toujours.",
                        icon: "warning",
                        type: "warning",
                        buttons: ["Annuler", "Oui!"],
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
                });

                const matiereSelect = document.getElementById("matiere");

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
                    7: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية",
                        "Sciences naturelles",
                        "التاريخ و الجغرافيا", "التربية المدنية"
                    ],
                    8: ["Mathématiques", "Français", "Anglais", "التربية الإسلامية", "اللغة العربية",
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
                    const selectedClasse = '{{ $Cours->id_classe }}';
                    const matiereOptionsForClasse = matiereOptions[selectedClasse];

                    matiereOptionsForClasse.forEach(matiere => {
                        const option = document.createElement("option");
                        option.text = matiere;
                        matiereSelect.appendChild(option);
                    });
                }


                // Initial update to set matiere options based on the default selected classe
                updateMatiereOptions();

                document.addEventListener('DOMContentLoaded', () => {
                    const matiereSelect = document.getElementById("matiere");
                    const selectedMatiereValue =
                        "{{ $Cours->matiere }}"; // Assuming you pass the selected matiere value to the view

                    // Find the option with the selected matiere value and set it as selected
                    const selectedOption = Array.from(matiereSelect.options).find(option => option.value ===
                        selectedMatiereValue);
                    if (selectedOption) {
                        selectedOption.selected = true;
                    }
                });

                var date_debutSelect = document.getElementById("date_debut");
                var option10 = date_debutSelect.querySelector('option[value="10:00:00"]');
                var option11 = date_debutSelect.querySelector('option[value="11:15:00"]');
                var option12 = date_debutSelect.querySelector('option[value="12:00:00"]');


                var selectedValue = '{{ $Cours->id_classe }}';
                date_debutSelect.disabled = false;
                // Remove options with values "10:00:00" and "12:00:00" when 1AF is selected
                if (selectedValue === "7" || selectedValue === "8" || selectedValue === "9" || selectedValue === "10" ||
                    selectedValue === "11" || selectedValue === "12" || selectedValue === "13" || selectedValue ===
                    "13" || selectedValue === "14"
                ) {
                    option11.style.display = "none";
                } else {
                    option11.style.display = "block";
                }

                // Remove option with value "11:15:00" when 2AF is selected
                if (selectedValue === "1" || selectedValue === "2" || selectedValue === "3" || selectedValue === "4" ||
                    selectedValue === "5" || selectedValue === "6") {
                    option10.style.display = "none";
                    option12.style.display = "none";
                } else {
                    option10.style.display = "block";
                    option12.style.display = "block";
                }






                function updatedate_finOptions() {
                    const date_debutSelect = document.getElementById("date_debut");
                    const date_finSelect = document.getElementById("date_fin");
                    const selectedValue = date_debutSelect.value;
                    const classeSelected = '{{ $Cours->id_classe }}';
                    const date_finSelected = '{{ $Cours->date_fin }}';

                    // Clear existing options
                    date_finSelect.innerHTML = "";

                    // Add new options based on selected value and grade level
                    if (selectedValue === "08:00:00") {
                        if (classeSelected === "7" || classeSelected === "8" || classeSelected === "9" || classeSelected === "10" ||
                            classeSelected === "11" || classeSelected === "12" || classeSelected === "13" || classeSelected === "14"
                        ) {
                            addOption(date_finSelect, "10:00:00", "10:00");

                        } else {
                            if (classeSelected === "1") {

                                addOption(date_finSelect, "11:00:00", "11:00", true)

                            } else {
                                addOption(date_finSelect, "11:00:00", "11:00", true)
                            }

                        }
                    } else if (selectedValue === "10:00:00") {
                        addOption(date_finSelect, "12:00:00", "12:00");
                    } else if (selectedValue === "11:15:00") {

                        if (classeSelected === "1") {

                            addOption(date_finSelect, "12:00:00", "12:00", true)

                        } else {
                            addOption(date_finSelect, "14:00:00", "14:00");
                        }
                    } else if (selectedValue === "12:00:00") {
                        addOption(date_finSelect, "14:00:00", "14:00");
                    }
                }

                function addOption(select, value, text, selected, display) {
                    const option = document.createElement("option");
                    option.value = value;
                    option.textContent = text;
                    option.selected = selected;
                    option.style.display = display;
                    select.appendChild(option);
                }

                // Call the function when the page loads
                window.onload = function() {
                    updatedate_finOptions();
                };
            </script>
        @endsection
