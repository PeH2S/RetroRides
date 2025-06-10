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
            font-weight: 500;
            padding: 8px 16px;
            border: none;
            background: transparent;
            color: #555;
            border-bottom: 2px solid transparent;
            margin-right: 16px;
        }

        .tab-link.active {
            color: #004E64;
            border-color: #004E64;
        }

        .card-anuncio {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 16px;
            background-color: white;
            transition: 0.2s ease;
        }

        .card-anuncio:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card-title {
            font-weight: 600;
            font-size: 18px;
            color: #004E64;
        }

        .btn-outline-custom {
            border: 1px solid #004E64;
            color: #004E64;
        }

        .btn-outline-custom:hover {
            background-color: #004E64;
            color: white;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-white border-end min-vh-100 p-0">
                <div class="text-center py-4 border-bottom">
                    <div
                        class="rounded-circle text-white mx-auto mb-2 sidebar-avatar d-flex justify-content-center align-items-center">
                        {{ strtoupper(Auth::user()->name[0]) }}
                    </div>
                    <strong class="d-block">{{ Auth::user()->name }}</strong>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>

                <nav class="nav flex-column px-3 py-3">
                    <a href="{{ route('anuncios-carros') }}" class="nav-link @if (request()->routeIs('anuncios-carros')) active @endif">
                        <i class="bi bi-search me-2"></i> Buscar veículo
                    </a>
                    <a href="{{ route('anunciar') }}" class="nav-link @if (request()->routeIs('anunciar')) active @endif">
                        <i class="bi bi-cash-stack me-2"></i> Vender meu veículo
                    </a>
                    <a href="{{ route('anuncios.index') }}"
                        class="nav-link @if (request()->routeIs('anuncios.*')) active @endif">
                        <i class="bi bi-megaphone me-2"></i> Meus anúncios
                    </a>
                    <a href="{{ route('chat.index') }}" class="nav-link @if (request()->routeIs('chat.*')) active @endif">
                        <i class="bi bi-chat-dots me-2"></i> Chat
                    </a>
                    <a href="{{ route('alertas.index') }}" class="nav-link @if (request()->routeIs('alertas.*')) active @endif">
                        <i class="bi bi-bell me-2"></i> Alertas
                    </a>
                    <a href="{{ route('minha-conta') }}" class="nav-link @if (request()->routeIs('minha-conta')) active @endif">
                        <i class="bi bi-person me-2"></i> Minha conta
                    </a>
                    <div class="ms-4">
                        <a href="{{ route('minha-conta') }}" class="nav-link py-1 text-muted">Editar dados</a>
                        <a href="{{ route('minha-conta') }}#personalizacao" class="nav-link py-1 text-muted">Personalização
                            e dados</a>
                    </div>
                    <a href="{{ route('ajuda') }}" class="nav-link @if (request()->routeIs('ajuda')) active @endif">
                        <i class="bi bi-question-circle me-2"></i> Ajuda
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="px-3 mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-box-arrow-right me-2"></i> Sair
                        </button>
                    </form>
                </nav>
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
                </div>

                @if ($meusAnuncios->isEmpty())
                    <div class="text-center mt-5">
                        <img src="{{ asset('images/empty-garage.png') }}" alt="Sem anúncios" style="max-width: 200px;">
                        <p class="mt-3 text-muted">Sua garagem ainda está vazia :(</p>
                        <a href="{{ route('anunciar') }}" class="btn btn-outline-custom">
                            Anuncie seu veículo
                        </a>
                    </div>
                @else
                    <div class="row">
                        @foreach ($meusAnuncios as $anuncio)
                            <div class="col-md-4 mb-4">
                                <div class="card-anuncio h-100 d-flex flex-column justify-content-between">
                                    @if ($anuncio->fotos->isNotEmpty())
                                        <img alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}"
                                            class="w-full h-48 object-cover"
                                            src="{{ Storage::url($anuncio->fotos->first()->caminho) }}" />
                                    @else
                                        <img alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}"
                                            class="w-full h-48 object-cover"
                                            src="https://via.placeholder.com/300x180?text={{ $tipoVeiculo === 'moto' ? 'Moto' : 'Carro' }}" />
                                    @endif
                                    <div>
                                        <p>{{ $anuncio->cor }}</p>
                                        <p>{{ $anuncio->situacao }}</p>
                                        <p class="text-muted small mb-2">Publicado em
                                            {{ $anuncio->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="mt-3 d-flex justify-content-between">
                                        <a href="/anuncios/{{ $anuncio->id }}"
                                            class="btn btn-sm btn-outline-custom">Ver</a>
                                        <a href="{{ route('anuncios.edit', $anuncio->id) }}" class="btn btn-sm btn-warning text-white">Editar</a>
                                        <form action="/meus-anuncios/{{ $anuncio->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Deseja mesmo excluir este anúncio?')">
                                                Excluir
                                            </button>
                                        </form>
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
