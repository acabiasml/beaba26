@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Novo Usuário</h2>

    <form method="POST" action="/usuarios">
        @csrf

        <label>Nome</label>
        <input name="name" required>

        <label>Email</label>
        <input name="email" required>

        <label>Papel</label>
        <select name="role">
            <option value="administrador">Administrador</option>
            <option value="gestor">Gestor</option>
            <option value="professor">Professor</option>
            <option value="aluno">Aluno</option>
            <option value="apoio">Apoio</option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>
</div>
@endsection
