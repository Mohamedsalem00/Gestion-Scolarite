@extends('layouts.layout')
@section('title', 'Classes')
@section('content2')

    <div class="container mt-5">
        <a href="{{ url('/classe/create') }}" class="btn btn-success btn-sm" title="Ajouter nouvau classe" id="allAction">
            <i class="bi bi-person-plus-fill"></i> Ajouter
        </a>
        <div id="classesList">
            <h3 class="mb-4">Liste des classes de scolarité</h3>
            @foreach ($classe as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Classe {{ $item->nom_classe }}</h5>
                        <p class="card-text">Niveau : {{ $item->niveau }}</p>
                        <p class="card-text">Nombre d'étudiants : {{ $item->etudiants->count() }}</p>
                        <a href="{{ url('/classe/' . $item->id_classe) }}"><button class="btn btn-secondary"
                                style="padding: 3px 4px 2px 4px;" id="allAction">Voir</button></a>
                        <a href="{{ url('/classe/' . $item->id_classe) . '/edit' }}"><button class="btn btn-primary"
                                style="padding: 3px 4px 2px 4px;" id="allAction">Modifier</button></a>
                        <form action="{{ route('classe.destroy', $item->id_classe) }}" method="POST" accept-charset="UTF-8"
                            style="display: inline; padding: 0" id="deleteForm">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a id="allAction">
                                <button type="submit" title="Suprimer l'etudient"
                                    class="btn btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip">
                                    <i class="bi bi-trash" aria-hidden="true"></i>Suprimer
                                </button>
                            </a>
                        </form>
                    </div>
                </div>
            @endforeach
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
