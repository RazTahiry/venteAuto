@extends('admin.admin')

@section('title', 'Tous les achats')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.achat.create') }}" class="btn btn-dark">Faire un achat</a>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">Numéro Achat</th>
                <th scope="col">Id Client</th>
                <th scope="col">Id Voiture</th>
                <th scope="col">Date</th>
                <th scope="col">Quantité</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($achats as $achat)
                <tr>
                    <td  scope="row"> {{ $achat->numAchat }} </td>
                    <td> {{ $achat->idCli }} </td>
                    <td> {{ $achat->idVoit }} </td>
                    <td> {{ $achat->date }} </td>
                    <td> {{ $achat->qte }} </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.achat.edit', $achat) }}" class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.achat.destroy', $achat) }}" method="POST">
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

    {{ $achats->links() }}

@endsection
