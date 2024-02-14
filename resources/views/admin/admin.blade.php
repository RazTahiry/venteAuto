<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Administration</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="bi bi-car-front"></i> venteAuto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
              @php
                  $route = request()->route()->getName();
              @endphp
              <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => str_contains($route, 'dashboard.')]) href="{{ route('admin.dashboard.index') }}">Dashboard</a>
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
            </div>
        </nav>
    </div>

    <div class="container mt-2">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

    </div>

    <script src="{{ asset('js/bootstrap-js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/apps.js') }}"></script>
</body>
</html>
