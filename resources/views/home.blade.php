@extends('layouts.layout')

@section('title', 'Accueil')

@section('content2')
    <style>
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        .content {

            margin: 0 auto;
            background-color: #fff;
            padding: 1rem;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }


        @media screen and (max-width: 768px) {
            .container {
                max-width: 506px;
                padding: 10px;
                font-size: 12px;
            }

            .btn {
                font-size: 10px;
            }

            h2 {
                font-size: 18px;
            }
            .card{
                width: auto;
            }
        }
    </style>
    <header>
        <h1 class="text-center">Page des Publications</h1>
    </header>

    <main class="container">
        <section>
            <h2>Résultats du Premier Trimestre</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Résultats de Premier Devoirs</h5>
                            <p class="card-text">Accédez aux résultats des premiers devoirs pour le premier trimestre.</p> <a
                                href="{{ url('/note/noteDevoir1') }}" class="btn btn-primary"><i class="fas fa-file-alt"></i>
                                Voir les résultats</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Résultats du Premier Examen</h5>
                            <p class="card-text">Accédez aux résultats du premier examen pour le premier trimestre.</p> <a
                                href="{{ url('/note/noteExamen1') }}" class="btn btn-primary"><i
                                    class="fas fa-file-alt"></i> Voir les
                                résultats</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2>Horaires d'Études</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Emplois du Temps</h5>
                            <p class="card-text">Consultez les emplois du temps pour le semestre en cours.</p> <a
                                href="{{ url('/cour/spectacle') }}" class="btn btn-primary"><i
                                    class="fas fa-calendar-alt"></i> Voir les
                                horaires</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2>Horaires de Devoirs et Examens</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Horaire des Premiers Devoirs</h5>
                            <p class="card-text">Consultez l'horaire des premiers devoirs pour le semestre en cours.</p> <a
                                href="{{ url('/evoluation/spectacleDevoir1') }}" class="btn btn-primary"><i
                                    class="fas fa-calendar-alt"></i> Voir les
                                horaires</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Horaire des Premiers Examens</h5>
                            <p class="card-text">Consultez l'horaire des premiers examens pour le semestre en cours.</p> <a
                                href="{{ url('/evoluation/spectacleExamen1') }}" class="btn btn-primary"><i
                                    class="fas fa-calendar-alt"></i> Voir les
                                horaires</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p class="text-center">&copy; 2023 École. Tous droits réservés.</p>
    </footer>
@endsection
