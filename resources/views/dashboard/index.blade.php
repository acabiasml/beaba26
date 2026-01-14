@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>

<p>
    Usuário: <strong>{{ auth()->user()->person->full_name }}</strong><br>
    Email: {{ auth()->user()->email }}<br>
    Perfil: {{ ucfirst(auth()->user()->role) }}
</p>

<hr>

{{-- ADMINISTRADOR --}}
@can('administrador')
    <h3>Administração do Sistema</h3>
    <ul>
        <li><a href="/usuarios/novo">Cadastrar usuários</a></li>
        <li><a href="#">Configurações gerais</a></li>
        <li><a href="#">Auditoria</a></li>
    </ul>
@endcan

{{-- GESTOR --}}
@can('gestor')
    <h3>Gestão Escolar</h3>
    <ul>
        <li><a href="#">Turmas</a></li>
        <li><a href="#">Componentes</a></li>
        <li><a href="#">Calendário</a></li>
        <li><a href="#">Fechamento do ano</a></li>
    </ul>
@endcan

{{-- PROFESSOR --}}
@can('professor')
    <h3>Área do Professor</h3>
    <ul>
        <li><a href="#">Diários de classe</a></li>
        <li><a href="#">Lançar notas</a></li>
        <li><a href="#">Frequência</a></li>
    </ul>
@endcan

{{-- ALUNO --}}
@can('aluno')
    <h3>Área do Aluno</h3>
    <ul>
        <li><a href="#">Histórico escolar</a></li>
        <li><a href="#">Boletim</a></li>
        <li><a href="#">Frequência</a></li>
    </ul>
@endcan

{{-- APOIO --}}
@can('apoio')
    <h3>Funcionário de Apoio</h3>
    <ul>
        <li><a href="#">Informações gerais</a></li>
    </ul>
@endcan
@endsection
