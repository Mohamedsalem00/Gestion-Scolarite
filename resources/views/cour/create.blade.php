@extends('layouts.layout')
@section('title', 'Ajouter')
@section('content2')

    <div class="container mt-5">
        <div aria-rowspan="row" style="width: 5%; font-size: 1.5rem">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Ajouter une classe de scolarité</h3>
                        <form action="{{ url('cour') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="jour">Jour:</label>
                                    <select id="jour" name="jour" class="form-select" required>
                                        <option value="" selected disabled>Sélectionner le jour</option>
                                        <option value="Lundi">Lundi</option>
                                        <option value="Mardi">Mardi</option>
                                        <option value="Mercredi">Mercredi</option>
                                        <option value="Jeudi">Jeudi</option>
                                        <option value="Vendredi">Vendredi</option>
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
                                    <label for="date_debut" class="form-label">Heure de début:</label>
                                    <select id="date_debut" name="date_debut" class="form-select" required
                                        onchange="updatedate_finOptions()" disabled>
                                        <option value="" selected disabled>Sélectionner l'heure</option>
                                        <option value="08:00:00">08:00</option>
                                        <option value="10:00:00">10:00</option>
                                        <option value="11:15:00">11:15</option>
                                        <option value="12:00:00">12:00</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_fin" class="form-label">Heure de fin:</label>
                                    <select id="date_fin" name="date_fin" class="form-control" required disabled required>
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
        var date_debutSelect = document.getElementById("date_debut");
        var option10 = date_debutSelect.querySelector('option[value="10:00:00"]');
        var option11 = date_debutSelect.querySelector('option[value="11:15:00"]');
        var option12 = date_debutSelect.querySelector('option[value="12:00:00"]');

        document.getElementById("id_classe").addEventListener("change", function() {
            var selectedValue = this.value;
            date_debutSelect.disabled = false;
            // Remove options with values "10:00:00" and "12:00:00" when 1AF is selected
            if (selectedValue === "7" || selectedValue === "8" || selectedValue === "9" || selectedValue === "10" ||
                selectedValue === "11" || selectedValue === "12" || selectedValue === "13" || selectedValue === "13" || selectedValue === "14"
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
        });

        // Reset the select options when the Classe select is reset
        document.getElementById("id_classe").addEventListener("reset", function() {
            option10.style.display = "block";
            option11.style.display = "block";
            option12.style.display = "block";
        });


        const classeSelect = document.getElementById("id_classe");
        const matiereSelect = document.getElementById("matiere");

        function updatedate_finOptions() {
            const date_debutSelect = document.getElementById('date_debut');
            const date_finSelect = document.getElementById('date_fin');
            const selectedValue = date_debutSelect.value;
            const classeSelect = document.getElementById("id_classe");
            const classeSelected = classeSelect.value;


            // Clear existing options in "date_fin" select
            date_finSelect.innerHTML = '';

            // Get the index of the selected value in the "date_debut" select
            const selectedIndex = date_debutSelect.selectedIndex;

            // Loop through options starting from the next index after the selected index
            if (selectedValue == '08:00:00') {
                const option10 = document.createElement('option');
                const option11 = document.createElement('option');
                const optionSelected = document.createElement('option');

                optionSelected.text = "Sélectionner l'heure";
                optionSelected.selected = true;
                optionSelected.disabled = true;
                option10.value = '10:00:00';
                option10.text = '10:00';
                option11.value = '11:00:00';
                option11.text = '11:00';
                date_finSelect.disabled = false;
                date_finSelect.appendChild(optionSelected);
                date_finSelect.appendChild(option10);
                if (classeSelected === "7" || classeSelected === "8" || classeSelected === "9" || classeSelected === "10" ||
                    classeSelected === "11" || classeSelected === "12" || classeSelected === "13" || classeSelected === "14") {
                    option10.selected = true;
                    optionSelected.style.display='none';

                } else {
                    date_finSelect.appendChild(option11);
                }
                if (classeSelected === "1" || classeSelected === "2" || classeSelected === "3" || classeSelected === "4" ||
                    classeSelected === "5" || classeSelected === "6") {
                    option11.selected = true;
                    option10.style.display='none';
                } else {
                    date_finSelect.appendChild(option10);
                }
            } else if (selectedValue == '11:15:00') {
                const option12 = document.createElement('option');
                const option14 = document.createElement('option');
                const optionSelected = document.createElement('option');
                optionSelected.text = "Sélectionner l'heure";
                optionSelected.selected = true;
                optionSelected.disabled = true;
                option12.value = '12:00:00';
                option12.text = '12:00';
                option14.value = '14:00:00';
                option14.text = '14:00';
                date_finSelect.disabled = false;
                date_finSelect.appendChild(optionSelected);
                date_finSelect.appendChild(option12);
                if(classeSelected === "1"){
                    option12.selected = true;
                }else{
                date_finSelect.appendChild(option14);
                }
                if (classeSelected === "1" || classeSelected === "2" || classeSelected === "3" || classeSelected === "4" ||
                    classeSelected === "5" || classeSelected === "6") {
                    option14.selected = true;
                    option12.style.display='none';
                } else {
                    date_finSelect.appendChild(option10);
                }
            } else if (selectedValue == '10:00:00') {
                const option12 = document.createElement('option');
                option12.value = '12:00:00';
                option12.text = '12:00';
                date_finSelect.disabled = false;
                date_finSelect.appendChild(option12);
            } else if (selectedValue == '12:00:00') {
                const option14 = document.createElement('option');
                option14.value = '14:00:00';
                option14.text = '14:00';
                date_finSelect.disabled = false;
                date_finSelect.appendChild(option14);

            }


        }

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
    </script>
@endsection
