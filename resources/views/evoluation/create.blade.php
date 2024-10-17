@extends('layouts.layout')
@section('title', 'Ajouter')
@section('content2')
    <?php
    use Carbon\Carbon;
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 2%; font-size: 1.5rem">
                            <a href="{{ url('/evoluation') }}" title="retourne"><i class="bi bi-arrow-left"></i></a>
                        </div>
                        <h3 class="card-title text-center mb-4">Ajouter une evoluation</h3>
                        <form action="{{ url('evoluation') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hDebut" class="form-label">Type:</label>
                                    <select class="form-select" name="type" id="type"
                                        onchange="updateDateOptions()" required>
                                        <option value="" disabled selected>Choisir le type</option>
                                        <option disabled>Devoirs</option>
                                        <option value="devoir1">Devoir 1</option>
                                        <option value="devoir2">Devoir 2</option>
                                        <option value="devoir3">Devoir 3</option>
                                        <option disabled>Examens</option>
                                        <option value="examen1">Examen 1</option>
                                        <option value="examen2">Examen 2</option>
                                        <option value="examen3">Examen 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jour" class="form-label">Date:</label>
                                    <select class="form-select" name="date" id="date" disabled required>
                                        <option selected disabled>selectioner le joure</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputClasse" class="form-label">Classe</label>
                                    <select id="id_classe" class="form-select" name="id_classe" required>
                                        <option value="" selected disabled>Choisir la classe</option>
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id_classe }}">{{ $item->niveau }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputMatiere" class="form-label">Matiere</label>
                                    <select id="matiere" name="matiere" class="form-select" disabled required>
                                        <option value="" selected disabled>Choisir le matiere</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hDebut" class="form-label">Heure de début:</label>
                                    <select id="hDebut" name="hDebut" class="form-select" required
                                        onchange="updateHFineOptions()">
                                        <option value="" selected disabled>Sélectionner l'heure</option>
                                        <option value="08:00:00">08:00</option>
                                        <option value="10:00:00">10:00</option>
                                        <option value="12:00:00">12:00</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hFine" class="form-label">Heure de fin:</label>
                                    <select id="hFine" name="hFine" class="form-control" required>
                                        <option value="" selected disabled>Sélectionner l'heure</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-save">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajouter les scripts Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        function updateMatiereOptions() {
            const selectedClasse = classeSelect.value;
            const matiereOptionsForClasse = matiereOptions[selectedClasse];

            matiereSelect.innerHTML = "";

            const defaultOption = document.createElement("option");
            defaultOption.text = "select matiere";
            defaultOption.value = "";
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

        function updateDateOptions() {
            const dateSelect = document.getElementById("date");
            const typeSelect = document.getElementById("type");
            const selectedValue = typeSelect.value;
            dateSelect.removeAttribute('disabled');
            dateSelect.innerHTML = "";


            if (selectedValue === "devoir1") {
                var DebutDevoir1 = new Date('2023-10-09');
                var FineDevoir1 = new Date('2023-10-13');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutDevoir1 <= FineDevoir1) {
                    var dayOfWeek = DebutDevoir1.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutDevoir1.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutDevoir1.setDate(DebutDevoir1.getDate() + 1);
                }
            } else if (selectedValue === "devoir2") {
                var DebutDevoir2 = new Date('2023-12-25');
                var FineDevoir2 = new Date('2023-12-29');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutDevoir2 <= FineDevoir2) {
                    var dayOfWeek = DebutDevoir2.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutDevoir2.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutDevoir2.setDate(DebutDevoir2.getDate() + 1);
                }
            }else if (selectedValue === "devoir3") {
                var DebutDevoir3 = new Date('2024-02-26');
                var FineDevoir3 = new Date('2024-03-01');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutDevoir3 <= FineDevoir3) {
                    var dayOfWeek = DebutDevoir3.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutDevoir3.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutDevoir3.setDate(DebutDevoir3.getDate() + 1);
                }
            }else if (selectedValue === "examen1") {
                var DebutExamen1 = new Date('2023-10-23');
                var FineExamen1 = new Date('2023-10-27');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutExamen1 <= FineExamen1) {
                    var dayOfWeek = DebutExamen1.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutExamen1.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutExamen1.setDate(DebutExamen1.getDate() + 1);
                }
            }else if (selectedValue === "examen2") {
                var DebutExamen2 = new Date('2024-01-08');
                var FineExamen2 = new Date('2024-01-12');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutExamen2 <= FineExamen2) {
                    var dayOfWeek = DebutExamen2.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutExamen2.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutExamen2.setDate(DebutExamen2.getDate() + 1);
                }
            }else if (selectedValue === "examen3") {
                var DebutExamen3 = new Date('2024-03-18');
                var FineExamen3 = new Date('2024-03-22');
                addOption(dateSelect,'', 'selectioner le joure',true,true);
                while (DebutExamen3 <= FineExamen3) {
                    var dayOfWeek = DebutExamen3.toLocaleDateString('fr-FR', {
                        weekday: 'long'
                    });
                    var formattedDate = DebutExamen3.toISOString().split('T')[0];
                    var optionLabel = formattedDate + " | " + dayOfWeek;
                    addOption(dateSelect, formattedDate, optionLabel);

                    DebutExamen3.setDate(DebutExamen3.getDate() + 1);
                }
            }
        }

        function updateHFineOptions() {
            const hDebutSelect = document.getElementById("hDebut");
            const hFineSelect = document.getElementById("hFine");

            const selectedValue = hDebutSelect.value;

            // Clear existing options
            hFineSelect.innerHTML = "";

            // Add new options based on selected value and grade level
            if (selectedValue === "08:00:00") {
                addOption(hFineSelect, "10:00:00", "10:00");
            } else if (selectedValue === "10:00:00") {
                addOption(hFineSelect, "12:00:00", "12:00");
            } else if (selectedValue === "12:00:00") {
                addOption(hFineSelect, "14:00:00", "14:00");
            }
        }

        function addOption(select, value, text, selected, display) {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = text;
            option.selected = selected;
            option.disabled=display;
            select.appendChild(option);
        }

        // Call the function when the page loads
        window.onload = function() {
            updateDateOptions();
            updateHFineOptions();
        };
    </script>
@endsection
