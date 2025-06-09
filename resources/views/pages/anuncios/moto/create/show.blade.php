@extends('static.layoutHome')

@section('main')
<div class="container my-5">
    <div class="bg-white p-4 shadow-sm rounded">

        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Marca:</strong> {{ $anuncio->marca }}</p>
                <p><strong>Modelo:</strong> {{ $anuncio->modelo }}</p>
                <p><strong>Ano Modelo:</strong> {{ $anuncio->ano_modelo }}</p>
                <p><strong>Ano Fabricação:</strong> {{ $anuncio->ano_fabricacao }}</p>
                <p><strong>Cor:</strong> {{ $anuncio->cor }}</p>
                <p><strong>Combustível:</strong> {{ $anuncio->combustivel }}</p>
                <p><strong>Portas:</strong> {{ $anuncio->portas }}</p>
                <p >Detalhes do Anúncio #{{ $anuncio->id }}</p>

                <p><strong>Quilometragem:</strong> {{ number_format($anuncio->quilometragem, 0, ',', '.') }} km</p>
                <p><strong>Preço:</strong> <span class="text-success">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</span></p>
            </div>
            <div class="col-md-6">
                <p><strong>Descrição:</strong></p>
                <p>{{ $anuncio->descricao }}</p>
                <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($anuncio->status) }}</span></p>
            </div>
        </div>

        <h5 class="mb-3">Fotos do Veículo</h5>
        <div class="row">
            @foreach($anuncio->fotos as $foto)
            <div class="col-6 col-md-3 mb-3">
                <img src="{{ asset('storage/' . $foto->caminho) }}" class="img-fluid rounded shadow-sm" alt="Foto">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
