@extends('base')

@section('title', 'Se connecter')

@section('content')

    <div class="mt-5 container">
        <form action="{{ route('login') }}" method="POST" class="vstack gap-3 mx-auto mt-4 pt-3 p-4 rounded shadow-lg"
            style="max-width: 500px;">

            <h1 class="text-center mb-4">@yield('title')</h1>

            @csrf

            @include('shared.input', [
                'label' => 'Email',
                'type' => 'email',
                'name' => 'email',
                'id' => 'email',
            ])
            @include('shared.input', [
                'label' => 'Mot de passe',
                'type' => 'password',
                'name' => 'password',
                'id' => 'password',
            ])

            <div>
                <button class="btn btn-dark mb-2" style="width: 100%;">Se connecter</button>
            </div>

        </form>
    </div>

    @if (session('success'))
        <div style="display: none;">
            {{ session('success') }}
        </div>
    @endif

    @include('sweetalert::alert')

@endsection
