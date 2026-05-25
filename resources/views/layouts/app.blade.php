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
        <a class="navbar-brand" href="#">Lancheria</a>
        <div>
            <a href="/categorias" class="text-white me-3">Categorias</a>
            <a href="/produtos" class="text-white me-3">Produtos</a>
            <a href="/pedidos" class="text-white">Pedidos</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>