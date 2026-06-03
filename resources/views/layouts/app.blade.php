<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lancheria</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-4 mb-4">
        <a class="navbar-brand" href="{{ route('categorias.index') }}">Lancheria</a>
        <div class="d-flex align-items-center gap-3">
            @auth
                <a href="{{ route('categorias.index') }}" class="text-white">Categorias</a>
                <a href="{{ route('produtos.index') }}" class="text-white">Produtos</a>
                <a href="{{ route('pedidos.index') }}" class="text-white">Pedidos</a>
                <span class="text-white-50">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Criar conta</a>
            @endauth
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
