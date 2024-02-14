@extends('admin.admin')

@section('title', 'Tous les clients')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.client.create') }}" class="btn btn-dark">Ajouter un client</a>
    </div>

    <table class="table table-striped table-responsive">
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
                            <a href="{{ route('admin.client.edit', $client) }}" class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.client.destroy', $client) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $clients->links() }}

@endsection
