@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Configuração Inicial do BEABÁ</h2>
    <p>Cadastre o administrador do sistema</p>

    <form method="POST" action="{{ route('setup.store') }}">
        @csrf

        <label>Nome</label>
        <input name="name" required>

        <label>Email institucional</label>
        <input name="email" required>

        <button type="submit">
            Criar administrador
        </button>
    </form>
</div>
@endsection
