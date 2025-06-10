@extends('static.layoutHome')

@section('main')
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9f9f9;
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

    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #004E64;
    }

    .form-section {
        background: white;
        border-radius: 8px;
        padding: 24px;
        border: 1px solid #ddd;
    }
</style>

<div class="container-fluid">
    <div class="row">
        {{-- Menu lateral --}}
        <div class="col-md-3 bg-white border-end min-vh-100 p-0">
            <div class="text-center py-4 border-bottom">
                <div class="rounded-circle text-white mx-auto mb-2 sidebar-avatar d-flex justify-content-center align-items-center">
                    {{ strtoupper(Auth::user()->name[0]) }}
                </div>
                <strong class="d-block">{{ Auth::user()->name }}</strong>
                <small class="text-muted">{{ Auth::user()->email }}</small>
            </div>

            <nav class="nav flex-column px-3 py-3">
                <a href="{{ route('anuncios-carros') }}" class="nav-link @if(request()->routeIs('anuncios-carros')) active @endif">
                    <i class="bi bi-search me-2"></i> Buscar veículo
                </a>
                <a href="{{ route('anunciar') }}" class="nav-link @if(request()->routeIs('anunciar')) active @endif">
                    <i class="bi bi-cash-stack me-2"></i> Vender meu veículo
                </a>
                <a href="{{ route('anuncios.index') }}" class="nav-link @if(request()->routeIs('anuncios.*')) active @endif">
                    <i class="bi bi-megaphone me-2"></i> Meus anúncios
                </a>
                <a href="{{ route('chat.index') }}" class="nav-link @if(request()->routeIs('chat.*')) active @endif">
                    <i class="bi bi-chat-dots me-2"></i> Chat
                </a>
                <a href="{{ route('alertas.index') }}" class="nav-link @if(request()->routeIs('alertas.*')) active @endif">
                    <i class="bi bi-bell me-2"></i> Alertas
                </a>
                <a href="{{ route('minha-conta') }}" class="nav-link @if(request()->routeIs('minha-conta')) active @endif">
                    <i class="bi bi-person me-2"></i> Minha conta
                </a>
                <a href="{{ route('ajuda') }}" class="nav-link @if(request()->routeIs('ajuda')) active @endif">
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

        {{-- Conteúdo principal --}}
        <div class="col-md-9 p-4">
            <h2 class="fw-bold mb-4 text-dark">Editar Anúncio</h2>

            <form method="POST" action="{{ route('anuncios.update', $anuncio->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-section mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Modelo</label>
                            <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $anuncio->modelo) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ano</label>
                            <input type="text" name="ano_modelo" class="form-control" value="{{ old('ano_modelo', $anuncio->ano_modelo) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cor</label>
                            <input type="text" name="cor" class="form-control" value="{{ old('cor', $anuncio->cor) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Preço (R$)</label>
                            <input type="number" name="preco" class="form-control" value="{{ old('preco', $anuncio->preco) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quilometragem</label>
                            <input type="text" name="quilometragem" class="form-control" value="{{ old('quilometragem', $anuncio->quilometragem) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Placa</label>
                            <input type="text" name="placa" class="form-control" value="{{ old('placa', $anuncio->placa) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4" class="form-control">{{ old('descricao', $anuncio->descricao) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-custom px-4">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
