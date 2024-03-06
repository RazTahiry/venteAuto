@extends('admin.admin')

@section('title', $achat->exists ? 'Editer un achat' : 'Faire un achat')

@section('content')

    <h1 class="d-flex justify-content-center align-items-center mb-3">@yield('title')</h1>

    <form class="mx-auto align-items-center p-4 rounded shadow-lg col col-lg-6"
        action="{{ route($achat->exists ? 'admin.achat.update' : 'admin.achat.store', $achat) }}" method="post">

        @csrf
        @method($achat->exists ? 'put' : 'post')

        <div class="d-flex justify-content-between">
            <div></div>
            <a class="text-dark me-2" href="{{ route('admin.client.create') }}" style="width: fit-content;">Ajouter un
                client</a>
        </div>
        <div class="form-group form-floating mb-3">
            <select name="idCli" id="idCli" class="form-control">
                <option disabled selected>Sélectionner un client...</option>
                @foreach ($clients as $client)
                    @if ($achat->exists)
                        @if ($achat->idCli == $client->idCli)
                            <option @selected($client->idCli) value="{{ $client->idCli }}">{{ $client->idCli }} |
                                {{ $client->nom }}</option>
                        @else
                            <option value="{{ $client->idCli }}">{{ $client->idCli }} | {{ $client->nom }}</option>
                        @endif
                    @else
                        <option value="{{ $client->idCli }}">{{ $client->idCli }} | {{ $client->nom }}</option>
                    @endif
                @endforeach
            </select>
            <label for="idCli">Client</label>
        </div>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-9">
                <div class="form-group form-floating mb-3">
                    <select name="idVoit" id="idVoit" class="form-control">
                        <option value="" disabled selected>Sélectionner une voiture...</option>
                        @foreach ($voitures as $voiture)
                            @if ($voiture->nombre != 0)
                                @if ($achat->exists)
                                    @if ($achat->idVoit == $voiture->idVoit)
                                        <option @selected($voiture->idVoit) value="{{ $voiture->idVoit }}">
                                            {{ $voiture->idVoit }} | {{ $voiture->Design }}</option>
                                    @else
                                        <option value="{{ $voiture->idVoit }}">{{ $voiture->idVoit }} |
                                            {{ $voiture->Design }}</option>
                                    @endif
                                @else
                                    <option value="{{ $voiture->idVoit }}">{{ $voiture->idVoit }} |
                                        {{ $voiture->Design }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <label for="idVoit">Voiture</label>
                </div>
            </div>

            <div class="col-3">
                @include('shared.input', [
                    'label' => 'Quantité',
                    'type' => 'number',
                    'name' => 'qte',
                    'id' => 'qte',
                    'value' => $achat->qte,
                ])
            </div>
        </div>

        {{-- <div id="voitures-additionnelles" class="row d-flex justify-content-between align-items-center"></div> <!-- Conteneur pour les voitures supplémentaires -->
        <div class="row">
            <div class="col-1 mb-3">
                <a id="btnPlus" type="button" class="btn btn-sm border-dark">Plus</a>
            </div>
            <div id="bouton-moins" class="col-1 mb-3"></div>
        </div> --}}

        @include('shared.input', [
            'label' => 'Date',
            'type' => 'date',
            'name' => 'date',
            'id' => 'date',
            'value' => $achat->date,
        ])
        <div>
            <button class="btn btn-dark" style="width: 100%;">
                @if ($achat->exists)
                    Modifier l'achat
                @else
                    Valider l'achat
                @endif
            </button>
        </div>
    </form>

@endsection
