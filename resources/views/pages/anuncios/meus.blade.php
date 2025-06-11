@extends('static.layoutHome')

@section('main')
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .nav-link {
        color: #555;
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 8px;
        transition: background-color 0.2s, color 0.2s;
    }

    .nav-link.active {
        color: #004E64 !important;
        background-color: #e6f2f4;
    }

    .nav-link:hover {
        background-color: #f4f4f4;
    }

    .btn-custom {
        background-color: #004E64;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #00394b;
    }

    .sidebar-avatar {
        background-color: #004E64;
        width: 60px;
        height: 60px;
        line-height: 60px;
        font-size: 24px;
    }

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
        color: #004E64;
        border-color: #004E64;
    }

    .tab-link:hover {
        color: #004E64;
        border-color: #004E64;
    }

    .card-anuncio {
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 0;
        background-color: white;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-anuncio:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .card-image {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        overflow: hidden;
        height: 180px;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .card-anuncio:hover .card-image img {
        transform: scale(1.05);
    }

    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }

    .badge-ativo {
        background-color: #e6f2f4;
        color: #004E64;
    }

    .badge-inativo {
        background-color: #f0f0f0;
        color: #6c757d;
    }

    .badge-finalizado {
        background-color: #dcedc8;
        color: #2e7d32;
    }

    .badge-cancelado {
        background-color: #ffcdd2;
        color: #c62828;
    }

    .card-body {
        padding: 16px 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-weight: 700;
        font-size: 20px;
        color: #004E64;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .vehicle-price {
        font-weight: 700;
        font-size: 18px;
        color: #004E64;
        margin-bottom: 12px;
    }

    .vehicle-details {
        display: flex;
        flex-wrap: wrap;
        gap: 14px 24px;
        font-size: 14px;
        color: #666;
        margin-bottom: 12px;
    }

    .vehicle-detail {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .vehicle-detail i {
        font-size: 16px;
        color: #004E64;
    }

    .published-date {
        font-size: 13px;
        color: #999;
        font-style: italic;
        margin-bottom: 16px;
    }

    .card-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-start;
    }

    .card-actions .btn {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 6px;
        min-width: 90px;
        white-space: nowrap;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-custom {
        border: 1.5px solid #004E64;
        color: #004E64;
        background: transparent;
    }

    .btn-outline-custom:hover {
        background-color: #004E64;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #b02a37;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        color: white;
    }

    .btn-success:hover {
        background-color: #1e7e34;
    }

    /* Responsive tweaks */
    @media (max-width: 576px) {
        .vehicle-details {
            gap: 8px 12px;
            font-size: 13px;
        }

        .card-title {
            font-size: 18px;
        }

        .vehicle-price {
            font-size: 16px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        {{-- Menu lateral --}}
        <div class="col-md-3 bg-white border-end min-vh-100 p-0">
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
                        <a href="{{ route('anunciar') }}" class="btn btn-outline-custom">
                            Anuncie seu veículo
                        </a>
                    @endif
                </div>
            @else
                <div class="row">
                    @foreach ($meusAnuncios as $anuncio)
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card-anuncio position-relative w-100 d-flex flex-column">
                                {{-- Badge de status --}}
                                <span
                                    class="status-badge
                                    @if ($anuncio->status === 'ativo') badge-ativo
                                    @elseif($anuncio->status === 'inativo') badge-inativo
                                    @elseif($anuncio->status === 'finalizado') badge-finalizado
                                    @elseif($anuncio->status === 'cancelado') badge-cancelado @endif">
                                    {{ ucfirst($anuncio->status) }}
                                </span>

                                <div class="card-image">
                                    @if ($anuncio->fotos->isNotEmpty())
                                        <img alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}"
                                            src="{{ Storage::url($anuncio->fotos->first()->caminho) }}" />
                                    @else
                                        <img alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}"
                                            src="https://via.placeholder.com/300x180?text={{ $tipoVeiculo === 'moto' ? 'Moto' : 'Carro' }}" />
                                    @endif
                                </div>

                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title" title="{{ $anuncio->marca }} {{ $anuncio->modelo }}">
                                            {{ $anuncio->marca }} {{ $anuncio->modelo }}
                                        </h5>
                                        <div class="vehicle-price">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</div>

                                        <div class="vehicle-details">
                                            <span class="vehicle-detail" title="Ano">
                                                <i class="bi bi-calendar"></i> {{ $anuncio->ano }}
                                            </span>
                                            <span class="vehicle-detail" title="Quilometragem">
                                                <i class="bi bi-speedometer2"></i>
                                                {{ number_format($anuncio->quilometragem, 0, '', '.') }} km
                                            </span>
                                        </div>

                                        <div class="vehicle-details">
                                            <span class="vehicle-detail" title="Cor">
                                                <i class="bi bi-palette"></i> {{ $anuncio->cor }}
                                            </span>
                                            <span class="vehicle-detail" title="Câmbio">
                                                <i class="bi bi-gear"></i> {{ $anuncio->cambio }}
                                            </span>
                                        </div>
                                    </div>

                                    <p class="published-date">
                                        <i class="bi bi-clock"></i> Publicado em {{ $anuncio->created_at->format('d/m/Y') }}
                                    </p>

                                    <div class="card-actions">
                                        <a href="/anuncios/{{ $anuncio->id }}" class="btn btn-sm btn-outline-custom" title="Ver detalhes">
                                            Ver detalhes
                                        </a>

                                        @if ($anuncio->status === 'ativo')
                                            <a href="{{ route('anuncios.edit', $anuncio->id) }}"
                                                class="btn btn-sm btn-warning text-white" title="Editar anúncio">
                                                Editar
                                            </a>
                                        @endif

                                        @if (in_array($anuncio->status, ['ativo', 'inativo']))
                                            <form action="/meus-anuncios/{{ $anuncio->id }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja mesmo excluir este anúncio?');">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" title="Excluir anúncio">Excluir</button>
                                            </form>
                                        @endif

                                        @if ($anuncio->status === 'ativo')
                                            <form action="{{ route('anuncios.update-status', $anuncio) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="finalizado">
                                                <button type="submit" class="btn btn-sm btn-success" title="Finalizar anúncio"
                                                    onclick="return confirm('Marcar este anúncio como finalizado?')">
                                                    Finalizar
                                                </button>
                                            </form>

                                            <form action="{{ route('anuncios.update-status', $anuncio) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelado">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Cancelar anúncio"
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
@endsection
