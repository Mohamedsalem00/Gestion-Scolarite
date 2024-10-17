@extends('layouts.layout')
@section('title', 'Add Note')
@section('content2')
    <div class="container mt-5">
        <div style="display: flex;" class="mb-3">
            <div style="width: 38%; font-size: 1.5rem">
                <a href="javascript:history.back()" title="retourne"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div>
                <h1 class="text-center">Ajouter note</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Vous pouvez supprimer l'élément</h4>
                        <form action="{{ route('note.destroy', $note->id_note) }}" method="POST" accept-charset="UTF-8"
                            id="deleteForm">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a>
                                <button type="submit" title="Suprimer la note"
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
                        <h4 class="card-title text-center mb-4">Modification la note</h4>
                        <form action="{{ route('note.update', ['note' => $note->id_note]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="input-group  col-6"
                                style="    display: flex;
                    flex-wrap: nowrap;">
                                <input type="text" name="note" id="note" class="form-control" placeholder="Note"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    value="{{ $note->note }}">
                                <span class="input-group-text" id="basic-addon2">/20</span>
                            </div>
                            <div class="mt-3 col-12">
                                <button type="submit" class="btn btn-primary">Add Note</button>
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
                const form = document.querySelector("form");
        const noteInput = document.getElementById('note');

        function validateNote() {
            var value = parseInt(noteInput.value);

            if (isNaN(value) || value > 20) {
                noteInput.setCustomValidity("Veuillez entrer une valeur valide jusqu'à 20.");
                return false;
            } else {
                noteInput.setCustomValidity('');
                return true;
            }
        }

        noteInput.addEventListener("input", validateNote);

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            if (
                validateNote()
            ) {
                form.submit();
            }
        });

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
