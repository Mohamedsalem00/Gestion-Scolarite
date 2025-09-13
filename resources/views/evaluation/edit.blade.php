@extends('layouts.layout')
@section('title', 'Modifier ou supprimer')
@section('content2')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Vous pouvez supprimer l'élément</h3>
                        <form action="{{ route('evoluation.destroy', $evoluation->id_evoluation) }}" method="POST"
                            accept-charset="UTF-8" id="deleteForm">
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
                        <h3 class="card-title text-center mb-4">Modification de l'evoluation</h3>
                        <form class="row g-3 form-dark" method="POST"
                            action="{{ route('evoluation.update', ['evoluation' => $evoluation->id_evoluation]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <label for="inputMatiere" class="form-label">Matiere</label>
                                <select id="matiere" name="matiere" class="form-select">

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_debut" class="form-label">Heure de début:</label>
                                <select id="date_debut" name="date_debut" class="form-select" required
                                    onchange="updatedate_finOptions()">
                                    <option value="08:00:00" {{ $evoluation->date_debut == '08:00:00' ? 'selected' : '' }}>08:00
                                    </option>
                                    <option value="10:00:00" {{ $evoluation->date_debut == '10:00:00' ? 'selected' : '' }}>10:00
                                    </option>
                                    <option value="12:00:00" {{ $evoluation->date_debut == '12:00:00' ? 'selected' : '' }}>12:00
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_fin" class="form-label">Heure de fin:</label>
                                <select id="date_fin" name="date_fin" class="form-control" required>

                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Enregistrer</button>

                            </div>
                        </form>
                    </div>
                </div>
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
                    const selectedClasse = '{{ $evoluation->id_classe }}';
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
                    const selectedMatiereValue = "{{ $evoluation->matiere }}"; 

                    const selectedOption = Array.from(matiereSelect.options).find(option => option.value ===
                        selectedMatiereValue);
                    if (selectedOption) {
                        selectedOption.selected = true;
                    }
                });

                var date_debutSelect = document.getElementById("date_debut");


                var selectedValue = '{{ $evoluation->id_classe }}';
                date_debutSelect.disabled = false;
             
                function updatedate_finOptions() {
                    const date_debutSelect = document.getElementById("date_debut");
                    const date_finSelect = document.getElementById("date_fin");
                    const selectedValue = date_debutSelect.value;
                    const classeSelected = '{{ $evoluation->id_classe }}';
                    const date_finSelected = '{{ $evoluation->date_fin }}';

                    date_finSelect.innerHTML = "";

                    if (selectedValue === "08:00:00") {
                        addOption(date_finSelect, "10:00:00", "10:00");
                    } else if (selectedValue === "10:00:00") {
                        addOption(date_finSelect, "12:00:00", "12:00");
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
