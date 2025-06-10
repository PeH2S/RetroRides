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

    .form-control:focus {
        box-shadow: none;
        border-color: #004E64;
    }

    .form-select:focus {
        box-shadow: none;
        border-color: #004E64;
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
                <div class="ms-4">
                    <a href="{{ route('minha-conta') }}" class="nav-link py-1 text-muted">Editar dados</a>
                    <a href="{{ route('minha-conta') }}#personalizacao" class="nav-link py-1 text-muted">Personalização e dados</a>
                </div>
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
            <h2 class="mb-4 fw-bold text-dark">Minha conta</h2>
            <div class="row">
                {{-- Meus dados --}}
                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 rounded border">
                        <h5 class="mb-3">Meus dados</h5>
                        <form action="{{ route('minha-conta.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome completo*</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gênero*</label>
                                <select id="gender" name="gender" class="form-select" required>
                                    <option disabled>Selecione</option>
                                    <option value="masculino" @selected(old('gender', Auth::user()->gender) === 'masculino')>Masculino</option>
                                    <option value="feminino" @selected(old('gender', Auth::user()->gender) === 'feminino')>Feminino</option>
                                    <option value="outro" @selected(old('gender', Auth::user()->gender) === 'outro')>Outro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Data de nascimento*</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate', Auth::user()->birthdate?->format('Y-m-d')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF*</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf', Auth::user()->cpf) }}" required>
                            </div>
                            <p class="small text-muted">Cadastro exclusivo para maiores de 18 anos.</p>
                        </form>
                    </div>
                </div>

                {{-- Endereço e contato --}}
                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 rounded border">
                        <h5 class="mb-3">Endereço e contato</h5>
                        <form action="{{ route('minha-conta.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text" id="cep" name="cep" class="form-control" value="{{ old('cep', Auth::user()->address->cep ?? '') }}" required>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">Estado*</label>
                                    <input type="text" id="state" name="state" class="form-control" value="{{ old('state', Auth::user()->address->state ?? '') }}" required>
                                </div>
                                <div class="col-md-8">
                                    <label for="city" class="form-label">Cidade*</label>
                                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city', Auth::user()->address->city ?? '') }}" required>
                                </div>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <label for="phone" class="form-label">Telefone*</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}" required>
                                </div>
                                <button type="button" class="btn btn-link text-danger ms-2 mt-4 p-0" onclick="document.getElementById('phone').removeAttribute('disabled');">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <form action="{{ route('minha-conta.update') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-custom px-4">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
