@extends('layouts.layout')
@section('title', 'Modifier ou supprimer')
@section('content2')
    <div class="container mt-5">
        <div style="width: 38%; font-size: 1.5rem">
            <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Vous pouvez supprimer l'élément</h3>
                        <form action="{{ route('cour.destroy', $Cours->id_cours) }}" method="POST" accept-charset="UTF-8"
                            id="deleteForm">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a>
                                <button type="submit" title="Suprimer l'etudient"
                                    class="btn btn-danger btn-flat show-alert-delete-box btn-sm">
                                    <i class="bi bi-trash" aria-hidden="true"></i>Suprimer
                                </button>
                            </a>
                        </form>
                    </div>
                </div>
                <p class="text" style="text-align: center;">ou</p>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Modification de la leçon</h3>
                        <form class="row g-3 form-dark" method="POST"
                            action="{{ route('cour.update', ['cour' => $Cours->id_cours]) }}">
                            {!! csrf_field() !!}
                            @method('PATCH')
                            <div class="form-group col-md-12">
                                <label for="jour">Jour:</label>
                                <select id="jour" name="jour" class="form-select">
                                    <option value="Lundi" {{ $Cours->jour == 'Lundi' ? 'selected' : '' }}>Lundi</option>
                                    <option value="Mardi" {{ $Cours->jour == 'Mardi' ? 'selected' : '' }}>Mardi</option>
                                    <option value="Mercredi" {{ $Cours->jour == 'Mercredi' ? 'selected' : '' }}>Mercredi
                                    </option>
                                    <option value="Jeudi" {{ $Cours->jour == 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                                    <option value="Vendredi" {{ $Cours->jour == 'Vendredi' ? 'selected' : '' }}>Vendredi
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hDebut" class="form-label">Heure de début:</label>
                                <select id="hDebut" name="hDebut" class="form-select" required
                                    onchange="updateHFineOptions()">
                                    <option value="08:00:00" {{ $Cours->hDebut == '08:00:00' ? 'selected' : '' }}>08:00
                                    </option>
                                    <option value="10:00:00" {{ $Cours->hDebut == '10:00:00' ? 'selected' : '' }}>10:00
                                    </option>
                                    <option value="11:15:00" {{ $Cours->hDebut == '11:15:00' ? 'selected' : '' }}>11:15
                                    </option>
                                    <option value="12:00:00" {{ $Cours->hDebut == '12:00:00' ? 'selected' : '' }}>12:00
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hFine" class="form-label">Heure de fin:</label>
                                <select id="hFine" name="hFine" class="form-control" required>

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

                var hDebutSelect = document.getElementById("hDebut");
                var option10 = hDebutSelect.querySelector('option[value="10:00:00"]');
                var option11 = hDebutSelect.querySelector('option[value="11:15:00"]');
                var option12 = hDebutSelect.querySelector('option[value="12:00:00"]');


                var selectedValue = '{{ $Cours->id_classe }}';
                hDebutSelect.disabled = false;
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






                function updateHFineOptions() {
                    const hDebutSelect = document.getElementById("hDebut");
                    const hFineSelect = document.getElementById("hFine");
                    const selectedValue = hDebutSelect.value;
                    const classeSelected = '{{ $Cours->id_classe }}';
                    const hFineSelected = '{{ $Cours->hFine }}';

                    // Clear existing options
                    hFineSelect.innerHTML = "";

                    // Add new options based on selected value and grade level
                    if (selectedValue === "08:00:00") {
                        if (classeSelected === "7" || classeSelected === "8" || classeSelected === "9" || classeSelected === "10" ||
                            classeSelected === "11" || classeSelected === "12" || classeSelected === "13" || classeSelected === "14"
                        ) {
                            addOption(hFineSelect, "10:00:00", "10:00");

                        } else {
                            if (classeSelected === "1") {

                                addOption(hFineSelect, "11:00:00", "11:00", true)

                            } else {
                                addOption(hFineSelect, "11:00:00", "11:00", true)
                            }

                        }
                    } else if (selectedValue === "10:00:00") {
                        addOption(hFineSelect, "12:00:00", "12:00");
                    } else if (selectedValue === "11:15:00") {

                        if (classeSelected === "1") {

                            addOption(hFineSelect, "12:00:00", "12:00", true)

                        } else {
                            addOption(hFineSelect, "14:00:00", "14:00");
                        }
                    } else if (selectedValue === "12:00:00") {
                        addOption(hFineSelect, "14:00:00", "14:00");
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
                    updateHFineOptions();
                };
            </script>
        @endsection
