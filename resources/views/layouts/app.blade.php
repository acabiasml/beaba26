<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>BEABÁ – Sistema de Gestão Escolar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Estilo simples (podemos trocar depois por Tailwind/Bootstrap) --}}
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background: #f5f6f7;
        }
        header {
            background: #1f2937;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
        }
        main {
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            max-width: 900px;
        }
        .flash-success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .flash-error {
            background: #fee2e2;
            color: #7f1d1d;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        button {
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <div>
        <strong>BEABÁ</strong>
    </div>

    @auth
        <a href="{{ route('dashboard') }}">Dashboard</a>
    @endauth

    <div>
        @auth
            {{ auth()->user()->person->full_name }} ({{ auth()->user()->email }})
            
            <form method="POST" action="/logout" style="display:inline">
                @csrf
                <button type="submit">Sair</button>
            </form>
        @else
            <a href="{{ route('google.login') }}">Entrar</a>
        @endauth
    </div>
</header>

<main>
    {{-- Mensagens flash --}}
    @if (session('success'))
        <div class="flash-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="flash-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        @yield('content')
    </div>
</main>

</body>
</html>
