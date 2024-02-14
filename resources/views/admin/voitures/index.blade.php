@extends('admin.admin')

@section('title', 'Toutes les voitures')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.voiture.create') }}" class="btn btn-dark">Ajout de voiture</a>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">Id Voiture</th>
                <th scope="col">Designation</th>
                <th scope="col">Prix</th>
                <th scope="col">Nombre</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($voitures as $voiture)
                <tr>
                    <td  scope="row"> {{ $voiture->idVoit }} </td>
                    <td> {{ $voiture->Design }} </td>
                    <td> {{ number_format($voiture->prix, thousands_separator: ' ') }} Ar</td>
                    <td> {{ $voiture->nombre }} </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.voiture.edit', $voiture) }}" class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.voiture.destroy', $voiture) }}" method="POST">
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

    {{ $voitures->links() }}

@endsection
