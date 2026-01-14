@extends('layouts.app')

@section('content')

@if ($isFirstAccess)
    <script>
        window.location.href = "{{ route('setup.create') }}";
    </script>
@endif

<div class="container">
    @auth
        <h2>Bem-vindo, {{ auth()->user()->name }}</h2>
        <p>{{ auth()->user()->email }}</p>

        <a href="/dashboard">Acessar sistema</a>
    @else
        <h2>BEABÁ – Sistema de Gestão Escolar</h2>

        <a href="{{ route('google.login') }}">
            Entrar com Google Institucional
        </a>
    @endauth
</div>

@endsection
