{{-- resources/views/pages/anuncios/details.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    <a href="{{ route('anuncios.index') }}" class="btn btn-outline-secondary mb-3">
        &larr; Voltar para a lista
    </a>

    <div class="bg-white p-4 shadow-sm rounded">
        <h4 class="mb-4">Detalhes do Anúncio #{{ $anuncio->id }}</h4>

        <div class="row mb-4">
            {{-- Coluna de dados principais --}}
            <div class="col-md-6">
                <p><strong>Marca:</strong> {{ $anuncio->marca }}</p>
                <p><strong>Modelo:</strong> {{ $anuncio->modelo }}</p>
                <p><strong>Ano Modelo:</strong> {{ $anuncio->ano_modelo }}</p>
                <p><strong>Ano Fabricação:</strong> {{ $anuncio->ano_fabricacao }}</p>
                <p><strong>Cor:</strong> {{ $anuncio->cor }}</p>
                <p><strong>Combustível:</strong> {{ $anuncio->combustivel }}</p>
                <p><strong>Portas:</strong> {{ $anuncio->portas }}</p>
                <p><strong>Quilometragem:</strong> {{ number_format($anuncio->quilometragem, 0, ',', '.') }} km</p>
                <p>
                    <strong>Preço:</strong>
                    <span class="text-danger">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</span>
                </p>
            </div>

            {{-- Coluna de descrição e status --}}
            <div class="col-md-6">
                <p><strong>Descrição:</strong></p>
                <p>{{ $anuncio->descricao }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="badge bg-success">{{ ucfirst($anuncio->status) }}</span>
                </p>
            </div>
        </div>

        {{-- Fotos --}}
        <h5 class="mb-3">Fotos do Veículo</h5>
        <div class="row">
            @foreach($anuncio->fotos as $foto)
                <div class="col-6 col-md-3 mb-3">
                    <img src="{{ asset('storage/' . $foto->caminho) }}"
                         class="img-fluid rounded shadow-sm"
                         alt="Foto do anúncio">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
