@extends('static.layoutHome')

@section('main')
<div class="container-fluid">
    <div class="row">
        {{-- Menu lateral --}}
        <div class="col-md-3 bg-light border-end vh-100 p-0">
            @include('components.sidebar-menu')
        </div>
        
        <div class="col-md-9 p-4">
            <h2 class="mb-4 fw-bold text-dark">Meus Anúncios</h2>

            <div class="d-flex border-bottom mb-4">
                <a href="{{ route('anuncios.index', ['status' => 'ativo']) }}"
                    class="tab-link {{ request('status', 'ativo') === 'ativo' ? 'active' : '' }}">
                    Ativos
                </a>
                <a href="{{ route('anuncios.index', ['status' => 'inativo']) }}"
                    class="tab-link {{ request('status') === 'inativo' ? 'active' : '' }}">
                    Inativos
                </a>
                <a href="{{ route('anuncios.index', ['status' => 'finalizado']) }}"
                    class="tab-link {{ request('status') === 'finalizado' ? 'active' : '' }}">
                    Finalizados
                </a>
                <a href="{{ route('anuncios.index', ['status' => 'cancelado']) }}"
                    class="tab-link {{ request('status') === 'cancelado' ? 'active' : '' }}">
                    Cancelados
                </a>
            </div>

            @if ($meusAnuncios->isEmpty())
                <div class="text-center mt-5">
                    <img src="{{ asset('images/empty-garage.png') }}" alt="Sem anúncios" style="max-width: 200px;">
                    <p class="mt-3 text-muted">Nenhum anúncio encontrado nesta categoria</p>
                    @if (request('status', 'ativo') === 'ativo')
                        <a href="{{ route('anunciar') }}" class="btn btn-outline-primary">
                            Anuncie seu veículo
                        </a>
                    @endif
                </div>
            @else
                <div class="row">
                    @foreach ($meusAnuncios as $anuncio)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                {{-- Badge de status --}}
                                <span class="position-absolute top-0 end-0 m-2 badge 
                                    @if ($anuncio->status === 'ativo') bg-primary
                                    @elseif($anuncio->status === 'inativo') bg-secondary
                                    @elseif($anuncio->status === 'finalizado') bg-success
                                    @elseif($anuncio->status === 'cancelado') bg-danger @endif">
                                    {{ ucfirst($anuncio->status) }}
                                </span>

                                <div class="card-img-top" style="height: 180px; overflow: hidden;">
                                    @if ($anuncio->fotos->isNotEmpty())
                                        <img class="img-fluid w-100 h-100 object-fit-cover" 
                                             src="{{ Storage::url($anuncio->fotos->first()->caminho) }}" 
                                             alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}">
                                    @else
                                        <img class="img-fluid w-100 h-100 object-fit-cover" 
                                             src="https://via.placeholder.com/300x180?text={{ $tipoVeiculo === 'moto' ? 'Moto' : 'Carro' }}" 
                                             alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}">
                                    @endif
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ $anuncio->marca }} {{ $anuncio->modelo }}</h5>
                                    <h6 class="card-subtitle mb-2 text-primary">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</h6>
                                    
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ $anuncio->ano }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="bi bi-speedometer2"></i> {{ number_format($anuncio->quilometragem, 0, '', '.') }} km
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="bi bi-palette"></i> {{ $anuncio->cor }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="bi bi-gear"></i> {{ $anuncio->cambio }}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <p class="card-text mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> Publicado em {{ $anuncio->created_at->format('d/m/Y') }}
                                        </small>
                                    </p>
                                    
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        <a href="/anuncios/{{ $anuncio->id }}" class="btn btn-outline-primary btn-sm">
                                            Ver detalhes
                                        </a>

                                        @if ($anuncio->status === 'ativo')
                                            <a href="{{ route('anuncios.edit', $anuncio->id) }}"
                                                class="btn btn-warning btn-sm text-white">
                                                Editar
                                            </a>
                                        @endif

                                        @if (in_array($anuncio->status, ['ativo', 'inativo']))
                                            <form action="/meus-anuncios/{{ $anuncio->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Deseja mesmo excluir este anúncio?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        @endif

                                        @if ($anuncio->status === 'ativo')
                                            <form action="{{ route('anuncios.update-status', $anuncio) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="finalizado">
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Marcar este anúncio como finalizado?')">
                                                    Finalizar
                                                </button>
                                            </form>

                                            <form action="{{ route('anuncios.update-status', $anuncio) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelado">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Cancelar este anúncio?')">
                                                    Cancelar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $meusAnuncios->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .tab-link {
        font-weight: 600;
        padding: 10px 18px;
        border: none;
        background: transparent;
        color: #555;
        border-bottom: 3px solid transparent;
        margin-right: 20px;
        transition: all 0.3s ease;
    }

    .tab-link.active {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .tab-link:hover {
        color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endsection