@extends('admin.admin')

@section('title', $voiture->exists ? "Editer un voiture" : "Ajout de voiture")

@section('content')

    <h1 class="d-flex justify-content-center align-items-center mb-3">@yield('title')</h1>

    <form class="col col-lg-6 mx-auto align-items-center p-3 border rounded shadow-sm bg-light" action="{{ route($voiture->exists ? 'admin.voiture.update' : 'admin.voiture.store', $voiture)}}" method="post">

        @csrf
        @method($voiture->exists ? 'put' : 'post')

        <div class="mb-3">
            @include('shared.input', ['label' => 'Id voiture', 'name' => 'idVoit', 'id' => 'idVoit', 'value' => $voiture->idVoit])
            @include('shared.input', ['label' => 'Designation', 'name' => 'Design', 'id' => 'Design', 'value' => $voiture->Design])
            @include('shared.input', ['label' => 'Prix', 'type' => 'number', 'name' => 'prix', 'id' => 'prix', 'value' => $voiture->prix])
            @include('shared.input', ['label' => 'Nombre', 'type' => 'number', 'name' => 'nombre', 'id' => 'nombre', 'value' => $voiture->nombre])
        </div>

        <div>
            <button class="btn btn-dark">
                @if ($voiture->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>

    </form>

@endsection
