@extends('admin.admin')

@section('title', 'Dashboard')

@section('content')

{{-- <div>
    <h1 class="text-center mb-5">@yield('title')</h1>
</div> --}}

<div class="row d-flex justify-content-between" style="margin-top: 100px;">

    <div class="col-3 rounded shadow bg-secondary text-light p-4" id="box1">
        <h2>Clients</h2>
        <p class="mb-1"><span class="h1">{{ $nbClient }}</span> enregistrés</p>
    </div>
    <div class="col-4 rounded shadow bg-success text-light p-5 px-3" id="box2">
        <h2 style="margin-top: -10px; margin-bottom: 20px;">Achats</h2>
        <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -10px;">
            <p><span class="h1">{{ $nbAchat }}</span> effectués</p>
            @php
                $somme = 0;
            @endphp
            @foreach ($ttAchats as $achat)
                @php
                    $somme += $achat->voiture->prix * $achat->qte;
                @endphp
            @endforeach
            <div>
                <p class="mb-0 fs-6 text-end">Récette total</p>
                <p class="text-end"><strong>{{ number_format($somme, thousands_separator:' ') }}</strong> Ar</p>
            </div>
        </div>
    </div>
    <div class="col-3 rounded shadow bg-primary text-light p-4 px-3" id="box3">
        @php
            $nbVoit = 0;
        @endphp
            @foreach ($ttVoitures as $voiture)
                @php
                    $nbVoit += $voiture->nombre;
                @endphp
            @endforeach
        <h2>Voitures</h2>
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-1"><span class="h1">{{ $nbVoit }}</span> dispo.</p>
            @php
                $nb = 0;
            @endphp
            @foreach ($ttAchats as $achat)
                @php
                    $nb += $achat->qte;
                @endphp
            @endforeach
            <p class="mb-0 text-end"><span class="h2">{{ $nb }}</span> vendues</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row" id="box5">
        <div class="col-6">
            {{-- <canvas id="recetteChart" width="800" height="400"></canvas> --}}
        </div>
        <div class="col-6 pe-0">
            <div class="text-center">
                <h5>Récette accumulée pour les 6 derniers mois</h5>
            </div>
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Mois</th>
                        <th scope="col" class="text-end">Récette Accumulée</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $recetteTotal = 0;
                    @endphp
                    @foreach ($recetteParMois as $mois => $recette)
                        <tr>
                            <td scope="row">{{ $mois }}</td>
                            <td class="text-end">{{ number_format($recette, thousands_separator:' ') }} Ar</td>
                        </tr>
                        @php
                            $recetteTotal += $recette;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <p class="text-end">Récette total (6 mois) : <strong>{{ number_format($recetteTotal, thousands_separator:' ') }} Ar</strong></p>
        </div>
    </div>
</div>

@endsection
