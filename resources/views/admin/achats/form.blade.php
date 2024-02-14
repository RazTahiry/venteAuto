@extends('admin.admin')

@section('title', $achat->exists ? "Editer un achat" : "Faire un achat")

@section('content')

    <h1 class="d-flex justify-content-center align-items-center mb-3">@yield('title')</h1>

    <form class="col col-lg-6 mx-auto align-items-center p-3 border rounded shadow-sm bg-light" action="{{ route($achat->exists ? 'admin.achat.update' : 'admin.achat.store', $achat)}}" method="post">

        @csrf
        @method($achat->exists ? 'put' : 'post')

        <div class="mb-3">
            @include('shared.input', ['label' => 'Numéro de l\'achat', 'name' => 'numAchat', 'id' => 'numAchat', 'value' => $achat->numAchat])
            <div class="form-group form-floating mb-3">
                <select name="idCli" id="idCli" class="form-control">
                    @foreach ($clients as $client)
                        <option value="{{ $client->idCli }}">{{ $client->idCli }} - {{ $client->nom }}</option>
                    @endforeach
                </select>
                <label for="idCli">Client</label>
            </div>
            <div class="form-group form-floating mb-3">
                <select name="idVoit" id="idVoit" class="form-control">
                    @foreach ($voitures as $voiture)
                        <option value="{{ $voiture->idVoit }}">{{ $voiture->idVoit }} - {{ $voiture->Design }}</option>
                    @endforeach
                </select>
                <label for="idVoit">Voiture</label>
            </div>
            @include('shared.input', ['label' => 'Date', 'type' => 'date', 'name' => 'date', 'id' => 'date', 'value' => $achat->date])
            @include('shared.input', ['label' => 'Quantité', 'type' => 'number', 'name' => 'qte', 'id' => 'qte', 'value' => $achat->qte])
        </div>

        <div>
            <button class="btn btn-dark">
                @if ($achat->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>

    </form>

@endsection
