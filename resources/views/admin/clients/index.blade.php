@extends('admin.admin')

@section('title', 'Tous les clients')

@section('content')

    <h1 class="text-center">@yield('title')</h1>
    <div class="d-flex justify-content-between align-items-center gap-2">
        <a href="{{ route('admin.client.create') }}" class="btn btn-dark my-2"><i class="bi bi-person-plus"></i> Ajouter</a>

        <div class="d-flex align-items-center">
            <form class="input-group my-2" style="max-width: 200px;" method="GET"
                action="{{ route('admin.client.index') }}">
                @csrf
                <input id="search" type="search" name="search" class="form-control"
                    placeholder="Recherche..."value="{{ request()->input('search') }}">
                <button id="rechercheClient" class="btn btn-dark" type="submit"><i class="bi bi-search bi-lg"></i></button>
            </form>
        </div>
    </div>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col" class="text-center">Contact</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($clients as $client)
                <tr>
                    <td scope="row"> {{ $client->idCli }} </td>
                    <td> {{ $client->nom }} </td>
                    <td class="text-center"> {{ $client->contact }} </td>
                    <td class="p-1">
                        <div class="d-flex justify-content-end">
                            <a id="aEdit" href="{{ route('admin.client.edit', $client) }}" class="btn btn-sm btn-dark"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i
                                    class="bi bi-pencil-square"></i></a>
                            <button id="btnSuppr" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#supprModal_{{ $client->idCli }}" data-bs-placement="top" title="Supprimer">
                                <i class="bi bi-trash3"></i>
                            </button>

                            <div class="modal fade" id="supprModal_{{ $client->idCli }}" tabindex="-1"
                                aria-labelledby="supprModalLabel_{{ $client->idCli }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="supprModalLabel_{{ $client->idCli }}">Confirmation
                                                de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer ce client?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Retour</button>
                                            <form action="{{ route('admin.client.destroy', $client) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Confirmer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $clients->links() }}

@endsection
