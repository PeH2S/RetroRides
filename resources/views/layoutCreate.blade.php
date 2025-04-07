<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Webmotors</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/stylesCreate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-expand-lg">
        <div class="w-100">
            @include('navBar_cabecalho')
        </div>
    </nav>

    <!-- Listagem de Veículos -->
    <div class="container">
        @yield('create')
    </div>

    <!-- Rodapé -->
    @include('rodape')
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('js/scriptCreate.js') }}"></script>
    
    <!-- Bootstrap Icons -->
    
</body>