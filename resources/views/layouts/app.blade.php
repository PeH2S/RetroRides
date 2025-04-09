<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroRides</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Seus CSS personalizados (se tiver) -->
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
</head>
<body>

    <!-- Navbar opcional -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">RetroRides</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Aqui entra o conteúdo específico de cada view -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
