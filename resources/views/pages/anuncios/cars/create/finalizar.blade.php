@extends('static.layoutHome')

@section('main')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bg-white shadow-sm rounded p-4">
                <h2 class="text-center mb-4 fw-semibold">Revise as informações do seu anúncio</h2>

                {{-- Dados do Veículo --}}
                <div class="mb-5">
                    <h5 class="text-primary fw-bold border-bottom pb-2 mb-3">Dados do Veículo</h5>
                    <div class="row text-muted">
                        <div class="col-md-6 mb-3">
                            <strong>Marca:</strong> {{ $dados['marca'] }}<br>
                            <strong>Modelo:</strong> {{ $dados['modelo'] }}<br>
                            <strong>Ano Modelo:</strong> {{ $dados['ano_modelo'] }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Ano Fabricação:</strong> {{ $dados['ano_fabricacao'] }}<br>
                            <strong>Cor:</strong> <span class="badge bg-light text-dark">{{ $dados['cor'] }}</span><br>
                            <strong>Quilometragem:</strong> {{ number_format($dados['quilometragem'], 0, ',', '.') }} km
                        </div>
                    </div>
                </div>

                {{-- Detalhes do Anúncio --}}
                <div class="mb-5">
                    <h5 class="text-primary fw-bold border-bottom pb-2 mb-3">Detalhes do Anúncio</h5>
                    <div class="row text-muted">
                        <div class="col-md-6 mb-3">
                            <strong>Preço:</strong> <span class="h5 text-success">R$ {{ number_format($dados['preco'], 2, ',', '.') }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Combustível:</strong> {{ $dados['combustivel'] }}<br>
                            <strong>Portas:</strong> {{ $dados['portas'] }}
                        </div>
                    </div>
                </div>

                {{-- Galeria de Fotos --}}
                <div class="mb-4">
                    <h5 class="text-primary fw-bold border-bottom pb-2 mb-3">Fotos do Veículo</h5>
                    <div class="row">
                        @forelse(session('anuncio.temp_fotos', []) as $foto)
                        <div class="col-6 col-md-3 mb-3">
                            <div class="border rounded overflow-hidden shadow-sm">
                                <img src="{{ asset('storage/' . $foto) }}" class="img-fluid" alt="Foto do veículo">
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">Nenhuma foto enviada.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Ações --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('anuncio.step4') }}" class="btn btn-outline-secondary">
                        &larr; Voltar
                    </a>
                    <form action="{{ route('anuncio.confirmar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            Confirmar Anúncio &rarr;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
