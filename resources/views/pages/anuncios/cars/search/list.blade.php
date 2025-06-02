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

                    @if ($anuncios->isEmpty())
                        <p>Nenhum anúncio encontrado para sua busca.</p>
                    @else
                        @foreach ($anuncios as $anuncio)
                            <div class="car-card mb-4">
                                <h4>{{ $anuncio->marca }} {{ $anuncio->modelo }}</h4>
                                <p>Ano: {{ $anuncio->ano_modelo }}</p>
                                <p>Preço: R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</p>
                                @if (isset($anuncio->distance))
                                    <p class="text-muted">Distância: {{ round($anuncio->distance, 1) }} km</p>
                                @endif
                                <a href="{{ route('anuncio.show', $anuncio->id) }}" class="btn btn-primary">Ver detalhes</a>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
