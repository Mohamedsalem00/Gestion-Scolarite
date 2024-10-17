@extends('layouts.layout')
@section('title', 'Enseignant')
@section('content2')
    <div class="container" id="container">
        <div class="row">
            <div class="col-12">
                <div class="card" id="card">
                    <div class="card-header" style="display: flex;">
                        <h4>Tous les enseignants de l'école</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/enseignant/create') }}" class="btn btn-success btn-sm"
                            title="Ajouter nouvau etudient" id="allAction">
                            <i class="bi bi-person-plus-fill"></i> Ajouter
                        </a>
                        </br>
                        </br>
                        <div class="table-responsive">
                            @if (count($enseignant) == 0)
                                <p>ll n'y a aucun enseignant á Afficher</p>
                            @else
                                <table id="studentsTable" class="table table-hover" style="font-size:13.5px;">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th scope="col" data-order="0">Nom & Prénoms</th>
                                            <th>Telephone</th>
                                            <th>Email</th>
                                            <th>Matiere</th>
                                            <th>Classe</th>
                                            <th>DateInscription</th>
                                            <th id="allAction">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($enseignant as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <p id="idtd1">{{ $item->nom }} {{ $item->prenom }}</p>
                                                </td>
                                                <td>{{ $item->telephone }}</td>
                                                <td>
                                                    <p id="idtd1">{{ $item->email }}</p>
                                                </td>
                                                <td>{{ $item->matiere }}</td>
                                                <td>{{ $item->classe->niveau }}</td>
                                                <td>
                                                    <p id="idtd2">{{ $item->created_at }}</p>
                                                </td>
                                                <td id="allAction">
                                                    <div id="Action">
                                                        <a href="{{ url('/enseignant/' . $item->id_enseignant) }}"
                                                            title="Afficher l'etudient"><button
                                                                class="btn btn-secondary btn-sm" id="btn"><i
                                                                    class="bi bi-eye"
                                                                    aria-hidden="true"></i>Voir</button></a>

                                                        <a href="{{ url('/enseignant/' . $item->id_enseignant . '/edit') }}"
                                                            title="Modifier l'etudient"><button
                                                                class="btn btn-primary btn-sm" id="btn"><i
                                                                    class="bi bi-pencil-square"
                                                                    aria-hidden="true"></i>Modifier</button></a>

                                                        <form
                                                            action="{{ route('enseignant.destroy', $item->id_enseignant) }}"
                                                            method="POST" accept-charset="UTF-8"
                                                            style="display: inline; padding: 0" id="deleteForm">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <a>
                                                                <button type="submit" title="Suprimer l'etudient"
                                                                    class="btn btn-danger btn-flat show-alert-delete-box btn-sm"
                                                                    data-toggle="tooltip" id="btn">
                                                                    <i class="bi bi-trash" aria-hidden="true"></i>Suprimer
                                                                </button>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                            @endif
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
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
    </script>
@endsection
