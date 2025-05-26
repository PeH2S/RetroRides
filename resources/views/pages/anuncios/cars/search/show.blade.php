@extends('static.layoutHome')

@section('main')
    <style>
        body {
            background-color: #f4f4f4;
        }

        .gallery img {
            width: 100%;
            border-radius: 8px;
        }

        .price-box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .car-info-box {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .tag {
            background-color: #eee;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            margin-right: 5px;
            display: inline-block;
        }

        .form-simular input {
            margin-bottom: 10px;
        }

        .gallery-thumbs img {
            height: 60px;
            width: 100px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 4px;
        }

        .specs {
            font-size: 14px;
            line-height: 1.6;
        }

        .label {
            font-weight: bold;
        }

        .main-image {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .gallery-thumbs {
            gap: 10px;
            margin-top: 10px;
        }
    </style>

    <div class="container mt-4">
        {{-- Informações principais do anúncio --}}
        <div
            class="mb-3 p-3 bg-white rounded shadow-sm d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
            <div>
                <h3 class="mb-0">
                    {{ $anuncio->titulo ?? $anuncio->marca . ' ' . $anuncio->modelo . ' ' . $anuncio->ano_modelo }}</h3>
                <div class="text-muted">
                    <i class="bi bi-geo-alt"></i> {{ $anuncio->cidade }}, {{ $anuncio->estado }}
                </div>
            </div>
            <div class="mt-3 mt-md-0 text-md-end">
                <div class="text-muted">Ligue para o anunciante:</div>
                <strong class="text-danger fs-5">
                    <i class="bi bi-telephone"></i> {{ $anuncio->telefone }}
                </strong>
            </div>
        </div>

        <div class="row">
            {{-- Coluna esquerda: imagens e informações --}}
            <div class="col-md-8">
                {{-- Galeria de imagens --}}
                <div class="gallery mb-3">
                    @if ($anuncio->fotos->isNotEmpty())
                        <img id="mainImage" src="{{ asset('storage/' . $anuncio->fotos->first()->caminho) }}"
                            class="main-image" alt="Veículo">
                    @else
                        <img id="mainImage" src="https://via.placeholder.com/800x400?text=Sem+Imagem" class="main-image"
                            alt="Sem imagem">
                    @endif
                </div>


                <div class="d-flex flex-wrap gap-2 gallery-thumbs mb-4">
                    @foreach ($anuncio->fotos->take(4) as $foto)
                        <img src="{{ asset('storage/' . $foto->caminho) }}" class="img-thumbnail thumb-img"
                            data-src="{{ asset('storage/' . $foto->caminho) }}" alt="Miniatura">
                    @endforeach
                </div>



                {{-- Informações resumidas --}}
                <div class="row text-center mt-3 border rounded p-3 bg-white">
                    <div class="col"><strong>Ano</strong><br>{{ $anuncio->ano_modelo }}</div>
                    <div class="col border-start">
                        <strong>Km</strong><br>{{ number_format($anuncio->quilometragem, 0, ',', '.') }}
                    </div>
                    <div class="col border-start"><strong>Cor</strong><br>{{ $anuncio->cor }}</div>
                    <div class="col border-start"><strong>Portas</strong><br>{{ $anuncio->portas }}</div>
                </div>

                <div class="mt-4">
                    <h5>Detalhes do veículo</h5>
                    <ul>
                        <li><strong>Marca:</strong> {{ $anuncio->marca }}</li>
                        <li><strong>Marca:</strong> {{ $anuncio->marca }}</li>
                        <li><strong>Combustível:</strong> {{ $anuncio->combustivel }}</li>
                        <li><strong>Placa:</strong> {{ $anuncio->placa }}</li>
                    </ul>
                </div>

                {{-- Seções adicionais --}}
                <div class="mt-4">
                    <h5>Descrição</h5>
                    <p>{{ $anuncio->descricao }}</p>
                </div>



                <div class="mt-4">
                    <h5>Condições</h5>
                    <ul>
                        @forelse ($anuncio->detalhes ?? [] as $detalhe)
                            <li>{{ $detalhe }}</li>
                        @empty
                            <li>Nenhum item informado.</li>
                        @endforelse
                    </ul>
                </div>

            </div>

            {{-- Coluna direita: preço e formulário fixo --}}
            <div class="col-md-4">
                <div style="position: sticky; top: 90px;">
                    <div class="card shadow-sm p-3">
                        <h4 class="text-danger">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</h4>
                        <small class="text-muted">Preço à vista</small>
                        <hr>
                        <form>
                            <input type="text" class="form-control mb-2" placeholder="Nome completo">
                            <input type="email" class="form-control mb-2" placeholder="E-mail">
                            <input type="tel" class="form-control mb-2" placeholder="Telefone">
                            <input type="text" class="form-control mb-2" placeholder="CPF">
                            <textarea class="form-control mb-2" rows="3" placeholder="Observações"></textarea>
                            <button type="button" class="btn w-100 mb-2" style="background-color: #004E64; color: white;">Mensagem</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const thumbs = document.querySelectorAll('.thumb-img');

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const newSrc = thumb.getAttribute('data-src');
                    mainImage.src = newSrc;
                });
            });
        });
    </script>
@endsection
