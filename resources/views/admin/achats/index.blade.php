@extends('admin.admin')

@section('title', 'Tous les achats')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.achat.create') }}" class="btn btn-dark"><i class="bi bi-cart3 bi-lg"></i> Faire un
            achat</a>
    </div>
    <div>
        <div class="mx-auto" style="width: fit-content">
            <h5>Recherche d’achats effectués entre deux dates</h5>
        </div>
        <form method="GET" action="{{ route('admin.achat.index') }}">
            @csrf
            <div class="row justify-content-center align-items-center">
                @include('shared.input', [
                    'class' => 'col col-md-3 ps-0',
                    'label' => 'Première Date',
                    'type' => 'date',
                    'name' => 'premiereDate',
                    'id' => 'premiereDate',
                    'value' => request()->input('premiereDate'),
                ])
                @include('shared.input', [
                    'class' => 'col col-md-3 ps-0',
                    'label' => 'Seconde Date',
                    'type' => 'date',
                    'name' => 'secondDate',
                    'id' => 'secondDate',
                    'value' => request()->input('secondDate'),
                ])
            </div>
            <div class="mx-auto mt-0" style="width: fit-content">
                <button class="btn btn-dark px-4" type="submit"><i class="bi bi-search bi-lg"></i> Rechercher</button>
            </div>
        </form>
    </div>
    <table class="mt-3 table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">Numéro</th>
                <th scope="col">Client</th>
                <th scope="col">Voiture</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Quantité</th>
                <th class="col text-end">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($achats as $achat)
                <tr>
                    <td scope="row"> {{ $achat->numAchat }} </td>
                    <td> {{ $achat->client->nom }} </td>
                    <td> {{ $achat->voiture->Design }} </td>
                    <td class="text-center"> {{ \Carbon\Carbon::parse($achat->date)->format('d-m-Y') }} </td>
                    <td class="text-center"> {{ $achat->qte }} </td>
                    <td class="p-1">
                        <div class="d-flex justify-content-end">
                            <button id="aEdit" type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#pdf_{{ $achat->numAchat }}" data-bs-placement="top" title="Facture">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </button>

                            <div class="modal fade" id="pdf_{{ $achat->numAchat }}" tabindex="-1"
                                aria-labelledby="pdfLabel_{{ $achat->numAchat }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfLabel_{{ $achat->numAchat }}">
                                                Facture</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Que voulez-vous faire?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('view-pdf') }}" method="POST" target="_blank">
                                                @csrf
                                                <input type="hidden" name="numAchat" value="{{ $achat->numAchat }}">
                                                <button type="submit" class="btn btn-dark">Visualiser la
                                                    facture</button>
                                            </form>
                                            <form action="{{ route('download-pdf') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="numAchat" value="{{ $achat->numAchat }}">
                                                <button type="submit" class="btn btn-success">Télecharger la
                                                    facture</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('admin.achat.edit', $achat) }}" class="btn btn-sm btn-dark"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Editer" style="border-radius: 0;"><i
                                    class="bi bi-pencil-square"></i></a>
                            <button id="btnSuppr" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#supprModal_{{ $achat->numAchat }}" data-bs-placement="top"
                                title="Supprimer">
                                <i class="bi bi-trash3"></i>
                            </button>

                            <div class="modal fade" id="supprModal_{{ $achat->numAchat }}" tabindex="-1"
                                aria-labelledby="supprModalLabel_{{ $achat->numAchat }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="supprModalLabel_{{ $achat->numAchat }}">
                                                Confirmation de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer cet achat?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Retour</button>
                                            <form action="{{ route('admin.achat.destroy', $achat) }}" method="POST">
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

    {{ $achats->links() }}

@endsection
