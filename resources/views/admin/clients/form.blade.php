@extends('admin.admin')

@section('title', $client->exists ? 'Editer un client' : 'Ajouter un client')

@section('content')

    <h1 class="d-flex justify-content-center align-items-center mb-3">@yield('title')</h1>

    <form class="col col-lg-6 mx-auto align-items-center p-4 rounded shadow-lg"
        action="{{ route($client->exists ? 'admin.client.update' : 'admin.client.store', $client) }}" method="post">

        @csrf
        @method($client->exists ? 'put' : 'post')

        <div class="mb-3">
            @include('shared.input', [
                'label' => 'Nom du client',
                'name' => 'nom',
                'id' => 'nom',
                'value' => $client->nom,
            ])
            @include('shared.input', [
                'label' => 'Contact du client',
                'name' => 'contact',
                'id' => 'contact',
                'value' => $client->contact,
            ])
        </div>

        <div>
            <button class="btn btn-dark" style="width: 100%;">
                @if ($client->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>

    </form>

@endsection
