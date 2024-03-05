@extends('admin.admin')

@section('title', 'Toutes les voitures')

@section('content')

    <h1 class="text-center">@yield('title')</h1>
    <div class="d-flex justify-content-between align-items-center gap-2">
        <a href="{{ route('admin.voiture.create') }}" class="btn btn-dark my-2"><i class="bi bi-plus-square bi-lg"></i>
            Ajouter</a>

        <div class="d-flex align-items-center">
            <form class="input-group my-2" style="max-width: 200px;" method="GET"
                action="{{ route('admin.voiture.index') }}">
                @csrf
                <input id="search" type="search" name="search" class="form-control" placeholder="Recherche..."
                    value="{{ request()->input('search') }}">
                <button id="rechercheVoiture" class="btn btn-dark" type="submit"><i
                        class="bi bi-search bi-lg"></i></button>
            </form>
        </div>
    </div>

    <table id="tableauVoiture" class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Désignation</th>
                <th scope="col">Prix</th>
                <th scope="col" class="text-center">Nombre</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($voitures as $voiture)
                @if ($voiture->nombre != 0)
                    <tr>
                        <td scope="row"> {{ $voiture->idVoit }} </td>
                        <td> {{ $voiture->Design }} </td>
                        <td> {{ number_format($voiture->prix, thousands_separator: ' ') }} Ar</td>
                        <td class="text-center"> {{ $voiture->nombre }} </td>
                        <td class="p-1">
                            <div class="d-flex justify-content-end">
                                <a id="aEdit" href="{{ route('admin.voiture.edit', $voiture) }}"
                                    class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Editer"><i class="bi bi-pencil-square"></i></a>
                                <button id="btnSuppr" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#supprModal_{{ $voiture->idVoit }}" data-bs-placement="top"
                                    title="Supprimer">
                                    <i class="bi bi-trash3"></i>
                                </button>

                                <div class="modal fade" id="supprModal_{{ $voiture->idVoit }}" tabindex="-1"
                                    aria-labelledby="supprModalLabel_{{ $voiture->idVoit }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="supprModalLabel_{{ $voiture->idVoit }}">
                                                    Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer cette voiture?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Retour</button>
                                                <form action="{{ route('admin.voiture.destroy', $voiture) }}"
                                                    method="POST">
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
                @endif
            @endforeach

        </tbody>
    </table>

    {{ $voitures->links() }}

@endsection
