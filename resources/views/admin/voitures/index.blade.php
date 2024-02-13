@extends('admin.admin')

@section('title', 'Tout les voitures')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.voiture.create') }}" class="btn btn-primary">Ajout de voiture</a>
    </div>

    <table class="table table-striped">
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
                    <td> {{ number_format($voiture->prix, thousands_separator: ' ') }} </td>
                    <td> {{ $voiture->nombre }} </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.voiture.edit', $voiture) }}" class="btn btn-sm btn-primary">Editer</a>
                            <form action="{{ route('admin.voiture.destroy', $voiture) }}" method="POST">
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

    {{ $voitures->links() }}

@endsection
