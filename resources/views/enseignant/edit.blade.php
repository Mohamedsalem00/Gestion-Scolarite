@extends('layouts.layout')
@section('title', 'Modifier')
@section('content2')
    <link rel="stylesheet" href="css/style.css">
    <div class="divform">
        <div class="card" style="margin: 20px;">
            <div class="card-header">
                <div style="display: flex;">
                    <div style="width: 35%; font-size: 1.5rem">
                        <a href="{{ url('/enseignant') }}" title="retourne"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div>
                        <h4>Modifier l'enseignant</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3 form-dark" id="myForm"
                    action="{{ route('enseignant.update', ['enseignant' => $enseignant->id_enseignant]) }}" method="POST">
                    {!! csrf_field() !!}
                    @method('PATCH')
                    <div class="col-md-4">
                        <label for="inputName4" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom"
                            value="{{ $enseignant->nom }}" required>
                            <div id="nom_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPrenom4" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom"
                            value="{{ $enseignant->prenom }}" required>
                            <div id="prenom_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-4">
                        <label for="inputTelephone" class="form-label">Telephone</label>
                        <input type="number" class="form-control" id="telephone" name="telephone"
                            value="{{ $enseignant->telephone }}" required>
                        <div id="telephone_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $enseignant->email }}" required>
                        <div id="email_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputClasse" class="form-label">Classe</label>
                        <select id="id_classe" class="form-select" name="id_classe" required>
                            @foreach ($classes as $item)
                                <option value="{{ $item->id_classe }}"
                                    {{ $enseignant->id_classe == $item->id_classe ? 'selected' : '' }}>
                                    {{ $item->niveau }}
                                </option>
                            @endforeach
                        </select>
                        <div id="id_classe_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputMatiere" class="form-label">Matiere</label>
                        <select id="matiere" name="matiere" class="form-select" required>

                        </select>
                        <div id="matiere_error" class="invalid-feedback"></div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
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
