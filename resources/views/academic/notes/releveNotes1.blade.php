@extends('layouts.layout')
@section('title', 'Releve de notes')
@section('content2')

    <div class="container mt-5">
        <div style="display: flex;" class="mb-5">
            <div style="width: 15%; font-size: 1.5rem" id="allAction">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div>
                <h1 class="text-center">Releve de notes du premier trimestre</h1>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="classSelect" id="allAction">Classe :</label>
            <select id="classSelect" class="form-select">
                @foreach ($classes as $class)
                    <option value="classe{{ $class->id_classe }}">{{ $class->nom_classe }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover tableNotes">
                
            </table>
        </div>
    </div>
    <script>
        const timetableData = {
            classe1: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF1 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe2: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF2 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe3: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF3 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe4: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF4 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe5: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF5 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe6: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AF6 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe7: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS1 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe8: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS2 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe9: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS3 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe10: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS4 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe11: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS5 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe12: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS6 as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe13: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS7D as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            classe14: `
            <tr>
                        <th>*</th>
                        <th>Nom & Prenom</th>
                        
                        <th>action</th>
                    </tr>
            @foreach ($AS7C as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nom }} {{ $item->prenom }} 
                    </td>
                  
                    <td>
                        <a href="{{ route('spectacleT1',['id' => $item->id_etudiant,'trimestre' => 'Premier trimestre' ]) }}" >
                            <button class="btn btn-secondary btn-sm" id="btn">
                                <i class="bi bi-eye" aria-hidden="true"></i>Voir
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach`,
            

        };

        // Function to update the tableNotes based on the selected class
        function updateTimetable(classValue) {
            const tableNotes = document.querySelector(".tableNotes");
            const timetableContent = timetableData[classValue];
            tableNotes.innerHTML = timetableContent;
        }

        // Listen for changes in the class select and update the tableNotes
        const classSelect = document.getElementById("classSelect");
        classSelect.addEventListener("change", () => {
            const selectedClass = classSelect.value;
            updateTimetable(selectedClass);
        });

        // Initial update to set the tableNotes based on the default selected class
        updateTimetable(classSelect.value);
    </script>
@endsection