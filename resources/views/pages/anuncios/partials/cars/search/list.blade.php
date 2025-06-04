{{-- resources/views/pages/anuncios/show.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    <a href="{{ route('anuncios.index') }}" class="btn btn-outline-secondary mb-3">
        &larr; Voltar para a lista
    </a>

    <div class="row g-4">
        {{-- Galeria de imagens --}}
        <div class="col-md-6">
            @if ($anuncio->fotos->isNotEmpty())
                <div id="carouselAnuncio" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($anuncio->fotos as $index => $foto)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($foto->path) }}"
                                     class="d-block w-100 rounded"
                                     alt="Foto {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAnuncio" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAnuncio" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            @else
                <img src="https://via.placeholder.com/600x400?text=Sem+imagem"
                     class="img-fluid rounded shadow-sm"
                     alt="Sem imagem">
            @endif
        </div>

        {{-- Informações do veículo --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-2">{{ $anuncio->titulo }}</h4>
                    <p class="text-muted mb-3">
                        {{ $anuncio->marca }} {{ $anuncio->modelo }} &bull;
                        Ano {{ $anuncio->ano_modelo }}/{{ $anuncio->ano_fabricacao }}
                    </p>
                    <p class="fs-4 text-danger mb-4">
                        R$ {{ number_format($anuncio->preco, 2, ',', '.') }}
                    </p>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Combustível:</strong> {{ $anuncio->combustivel }}</li>
                        <li class="list-group-item"><strong>Cor:</strong> {{ $anuncio->cor }}</li>
                        <li class="list-group-item"><strong>Quilometragem:</strong> {{ $anuncio->quilometragem ?? '–' }} km</li>
                        <li class="list-group-item"><strong>Portas:</strong> {{ $anuncio->portas ?? '–' }}</li>
                        <li class="list-group-item"><strong>Localização:</strong> {{ $anuncio->localizacao }}</li>
                        <li class="list-group-item"><strong>Situação:</strong> {{ ucfirst($anuncio->situacao) }}</li>
                    </ul>

                    <div class="mb-4">
                        <h5 class="mb-2">Descrição</h5>
                        <p>{{ $anuncio->descricao }}</p>
                    </div>

                    <a href="mailto:{{ $anuncio->user->email }}" class="btn btn-danger">
                        Interessado &mdash; Entrar em contato
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
