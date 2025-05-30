@extends('static.layoutHome')

@section('main')
    <style>
        body {

            background-color: #f8f9fa;

        }

        .filtro {

            background: #fff;

            border-radius: 8px;

            padding: 20px;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

        }

        .card-veiculo {

            border: 1px solid #ddd;

            border-radius: 8px;

            overflow: hidden;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);

            background: #fff;

        }

        .card-veiculo img {

            width: 100%;

            height: 180px;

            object-fit: cover;

        }

        .card-veiculo .card-body {

            padding: 10px;

        }

        .preco {

            font-weight: bold;

            font-size: 18px;

            color: #000;

        }
    </style>
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-12 mb-3">
                <h4>Carros usados e seminovos em São Paulo</h4>
            </div>

            <div class="col-md-3">
                <div class="filtro">
                    <h6>Filtros aplicados</h6>
                    <span class="badge bg-light text-dark">São Paulo</span>
                    <hr>
                    <h6>Categoria</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" checked>
                        <label class="form-check-label">Carros</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio">
                        <label class="form-check-label">Motos</label>
                    </div>
                    <hr>
                    <h6>Localização</h6>
                    <input type="text" class="form-control" placeholder="Digite sua cidade">
                </div>
            </div>

            <div class="col-md-9">
                <div class="row g-3">

                    @foreach (range(1, 6) as $i)
                        <div class="col-md-4">
                            <div class="card-veiculo">
                                <img src="https://via.placeholder.com/300x180?text=Veiculo+{{ $i }}"
                                    alt="Veículo">
                                <div class="card-body">
                                    <h6>Veículo {{ $i }} - Modelo</h6>
                                    <p class="text-muted mb-1">Ano 2025/2025 • 0 Km</p>
                                    <p class="preco">R$ {{ number_format(100000 + $i * 10000, 0, ',', '.') }}</p>
                                    <a href="#" class="btn btn-dark w-100">Ver oferta</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
