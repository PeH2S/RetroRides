<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Marca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FAF3DD;
        }
        .navbar {
            background-color: #004E64;
        }
        .navbar-brand, .nav-link {
            color: #F4E3C3 !important;
        }
        .navbar-nav .nav-link {
            font-weight: bold;
        }
        .search-bar {
            background-color: #004E64;
            padding: 20px;
            border-radius: 8px;
            color: #fff;
        }
        .search-bar input {
            background-color: #F4E3C3;
            border: none;
            color: #004E64;
        }
        .card {
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
        }
        .footer {
            background-color: #004E64;
            color: #F4E3C3;
            padding: 20px;
            text-align: center;
        }
        .btn-custom {
            background-color: #004E64;
            color: #F4E3C3;
            border: none;
            width: 100%;
            text-transform: uppercase;
        }
        .btn-custom:hover {
            background-color: #F4E3C3;
            color: #004E64;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @include('navBar_cabecalho')
        </div>
    </nav>

    <!-- Barra de Busca -->
    <div class="container mt-5">
        @include('barraBusca')
    </div>

    <h1>Criar Marca</h1>
    
</body>
</html>




@include('rodape')