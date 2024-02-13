@extends('admin.admin')

@section('title', 'Tout les clients')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.client.create') }}" class="btn btn-primary">Ajouter un client</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id Client</th>
                <th scope="col">Nom</th>
                <th scope="col">Contact</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($clients as $client)
                <tr>
                    <td  scope="row"> {{ $client->idCli }} </td>
                    <td> {{ $client->nom }} </td>
                    <td> {{ $client->contact }} </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.client.edit', $client) }}" class="btn btn-sm btn-primary">Editer</a>
                            <form action="{{ route('admin.client.destroy', $client) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $clients->links() }}

@endsection
