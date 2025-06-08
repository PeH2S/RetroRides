{{-- resources/views/pages/anuncios/cars/confirm.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    {{-- Inclui a barra de etapas (passo 4 ativo) --}}
    @include('pages.anuncios.partials.steps', ['step' => 4])

    <h4 class="mb-4">Confirmar Anúncio</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Dados do veículo e detalhes --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <p class="card-text">{{ $dados['descricao'] }}</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Marca:</strong> {{ $dados['marca'] }}</li>
                <li class="list-group-item"><strong>Modelo:</strong> {{ $dados['modelo'] }}</li>
                <li class="list-group-item"><strong>Ano do Modelo:</strong> {{ $dados['ano_modelo'] }}</li>
                <li class="list-group-item"><strong>Ano de Fabricação:</strong> {{ $dados['ano_fabricacao'] }}</li>
                <li class="list-group-item"><strong>Combustível:</strong> {{ $dados['combustivel'] }}</li>
                <li class="list-group-item"><strong>Cor:</strong> {{ $dados['cor'] }}</li>
                <li class="list-group-item"><strong>Preço:</strong> R$ {{ number_format($dados['preco'], 2, ',', '.') }}</li>
                <li class="list-group-item"><strong>Localização:</strong> {{ $dados['localizacao'] }}</li>
                <li class="list-group-item"><strong>Quilometragem:</strong> {{ number_format($dados['quilometragem'], 0, ',', '.') }} km</li>
                <li class="list-group-item"><strong>Portas:</strong> {{ $dados['portas'] }}</li>
                <li class="list-group-item"><strong>Placa:</strong> {{ $dados['placa'] }}</li>
                <li class="list-group-item"><strong>Situação:</strong> {{ ucfirst($dados['situacao']) }}</li>
                <li class="list-group-item"><strong>Condições:</strong> {{ implode(', ', $dados['condicoes'] ?? []) ?: '–' }}</li>
                <li class="list-group-item"><strong>Opcionais:</strong> {{ $dados['opcionais'] ?? '–' }}</li>
                <li class="list-group-item"><strong>Observações:</strong> {{ $dados['observacoes'] ?? '–' }}</li>
            </ul>
        </div>
    </div>

    {{-- Fotos temporárias --}}
    <h5 class="mb-3">Fotos do Veículo</h5>
    <div class="row mb-4">
        @foreach($fotos as $fotoPath)
            <div class="col-6 col-md-3 mb-3">
                <img src="{{ asset('storage/' . $fotoPath) }}"
                     class="img-fluid rounded shadow-sm"
                     alt="Foto do anúncio">
            </div>
        @endforeach
    </div>

    {{-- Botões Voltar / Confirmar --}}
    <div class="d-flex justify-content-between mb-5">
        <a href="{{ route('anuncio.step4') }}" class="btn btn-outline-secondary">
            &larr; Voltar
        </a>

        <form action="{{ route('anuncio.confirmar') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="btn btn-danger">
                Confirmar e Publicar
            </button>
        </form>
    </div>
</div>
@endsection
