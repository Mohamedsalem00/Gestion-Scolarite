@extends('layouts.layout')
@section('title', 'Etudian')
@section('content2')
    <div class="container" id="container">
        <div class="row">
            <div class="col-12">
                <div class="card" id="card">
                    <div class="card-header" style="display: flex;">
                        <h4>Tous les étudients de l'école</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/etudiant/create') }}" class="btn btn-success btn-sm"
                            title="Ajouter nouvau etudient" id="allAction">
                            <i class="bi bi-person-plus-fill"></i> Ajouter
                        </a>
                        </br>
                        </br>
                        <div class="table-responsive">
                            @if (count($etudiant) == 0)
                                <p>ll n'y a aucun etudiant á Afficher</p>
                            @else
                                <table id="studentsTable" class="table table-hover" style="font-size:13.5px;">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>*</th>
                                            <th scope="col" data-order="0">Nom & Prénoms</th>
                                            <th>Telephone</th>
                                            <th>Date-Naissance</th>
                                            <th>Adresse</th>
                                            <th>Genre</th>
                                            <th>Classe</th>
                                            <th>DateInscription</th>
                                            <th id="allAction">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($etudiant as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                <td>
                                                    <p id="idtd1">{{ $item->nom }} {{ $item->prenom }}</p>
                                                </td>
                                                <td>{{ $item->telephone }}</td>
                                                <td>
                                                    <p id="idtd1">{{ $item->date_naissance }}</p>
                                                </td>
                                                <td>{{ $item->adresse }}</td>
                                                <td>{{ $item->genre }}</td>
                                                <td>{{ $item->classe->niveau }}</td>
                                                <td>
                                                    <p id="idtd2">{{ $item->created_at }}</p>
                                                </td>
                                                <td id="allAction">
                                                    <div id="Action" >
                                                        <a href="{{ url('/etudiant/' . $item->id_etudiant) }}"
                                                            title="Afficher l'etudient"><button
                                                                class="btn btn-secondary btn-sm" id="btn"><i
                                                                    class="bi bi-eye"
                                                                    aria-hidden="true"></i>Voir</button></a>

                                                        <a href="{{ url('/etudiant/' . $item->id_etudiant . '/edit') }}"
                                                            title="Modifier l'etudient"><button
                                                                class="btn btn-primary btn-sm" id="btn"><i
                                                                    class="bi bi-pencil-square"
                                                                    aria-hidden="true"></i>Modifier</button></a>

                                                        <form action="{{ route('etudiant.destroy', $item->id_etudiant) }}"
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
