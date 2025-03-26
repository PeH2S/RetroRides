<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroRides - Marketplace de Carros</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @include('navBar_cabecalho')
        </div>
    </nav>

    <!-- Barra de Busca -->
    <div class="container mt-5">
        @include('barraBusca')
    </div>
    

    <!-- Listagem de Veículos -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="" class="card-img-top" alt="Carro Vintage">
                    <div class="card-body">
                        <h5 class="card-title">Chevrolet Opala 1975</h5>
                        <p class="card-text">R$ 50.000,00 - São Paulo/SP</p>
                        <a href="#" class="btn btn-custom">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="" class="card-img-top" alt="Carro Vintage">
                    <div class="card-body">
                        <h5 class="card-title">Ford Maverick 1973</h5>
                        <p class="card-text">R$ 80.000,00 - Rio de Janeiro/RJ</p>
                        <a href="#" class="btn btn-custom">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="" class="card-img-top" alt="Carro Vintage">
                    <div class="card-body">
                        <h5 class="card-title">Volkswagen Karmann-Ghia 1970</h5>
                        <p class="card-text">R$ 65.000,00 - Belo Horizonte/MG</p>
                        <a href="#" class="btn btn-custom">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    @include('rodape')
