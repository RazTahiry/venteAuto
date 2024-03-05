<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Administration</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('Favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('Favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('Favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('Favicon/site.webmanifest') }}">
    <style>
        @layer reset {
            button {
                all: unset;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container px-0">
                <a class="navbar-brand me-0" href="{{ route('home') }}" style="margin-top: -3px;"><i
                        class="bi bi-car-front fs-4"></i> venteAuto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @php
                    $route = request()->route()->getName();
                @endphp

                <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">
                    <div class="mx-auto">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_contains($route, 'dashboard.')])
                                    href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_contains($route, 'client.')]) href="{{ route('admin.client.index') }}">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_contains($route, 'voiture.')]) href="{{ route('admin.voiture.index') }}">Voitures</a>
                            </li>
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_contains($route, 'achat.')]) href="{{ route('admin.achat.index') }}">Achats</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="nav-link px-0" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deconnexionModal"><i class="bi bi-box-arrow-right"></i>
                                    Déconnexion</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        @auth
            <div class="modal fade" id="deconnexionModal" tabindex="-1" aria-labelledby="deconnexionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deconnexionModalLabel">Déconnexion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Voulez-vous vraiment vous déconnecter?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-danger">Oui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    <div class="container px-0" style="margin-top: 70px;">

        @if (session('success'))
            <div style="display: none;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

        @include('sweetalert::alert')

    </div>

    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
