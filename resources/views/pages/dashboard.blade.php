{{-- resources/views/pages/dashboard.blade.php --}}
@extends('static.layoutHome') {{-- caso você já use este layout, mantenha. Se não, remova esta linha. --}}

@section('main')
<div class="container-fluid">
    <div class="row">
        {{-- ========= COLUNA LATERAL (MENU) ========= --}}
        <div class="col-md-3 bg-light border-end vh-100 p-0">
            <div class="text-center py-4">
                {{-- Avatar circular com inicial do usuário --}}
                <div class="rounded-circle bg-secondary text-white mx-auto mb-2"
                     style="width: 60px; height: 60px; line-height: 60px; font-size: 24px;">
                    {{ strtoupper(Auth::user()->name[0]) }}
                </div>
                {{-- Nome e e-mail --}}
                <div>
                    <strong class="d-block">{{ Auth::user()->name }}</strong>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
            </div>

            <nav class="nav flex-column px-2">
                {{-- Cada link pode apontar para a rota correta da sua aplicação --}}
                <a href="{{ route('anuncios-carros') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('anuncios-carros')) active @endif">
                    <i class="bi bi-search me-2"></i>
                    Buscar veículo
                </a>

                <a href="{{ route('anunciar') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('anunciar')) active @endif">
                    <i class="bi bi-cash-stack me-2"></i>
                    Vender meu veículo
                </a>

                <a href="{{ route('anuncios.index') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('anuncios.*')) active @endif">
                    <i class="bi bi-megaphone me-2"></i>
                    Meus anúncios
                </a>

                <a href="{{ route('chat.index') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('chat.*')) active @endif">
                    <i class="bi bi-chat-dots me-2"></i>
                    Chat
                </a>

                <a href="{{ route('favoritos.index') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('favoritos.*')) active @endif">
                    <i class="bi bi-heart me-2"></i>
                    Favoritos
                </a>

                <a href="{{ route('alertas.index') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('alertas.*')) active @endif">
                    <i class="bi bi-bell me-2"></i>
                    Alertas
                </a>

                <a href="{{ route('financiamento.index') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('financiamento.*')) active @endif">
                    <i class="bi bi-currency-dollar me-2"></i>
                    Financiamento
                </a>

                {{-- Menu “Minha conta” com submenu --}}
                <a href="{{ route('minha-conta') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('minha-conta')) active @endif">
                    <i class="bi bi-person me-2"></i>
                    Minha conta
                </a>
                <div class="ms-4 mb-2">
                    <a href="{{ route('minha-conta') }}"
                       class="nav-link py-1 @if(request()->routeIs('minha-conta')) text-decoration-underline @endif">
                        Editar dados
                    </a>
                    <a href="{{ route('minha-conta') }}#personalizacao"
                       class="nav-link py-1 @if(request()->routeIs('minha-conta') && request()->getFragment() === 'personalizacao') text-decoration-underline @endif">
                        Personalização e dados
                    </a>
                </div>

                <a href="{{ route('ajuda') }}"
                   class="nav-link d-flex align-items-center @if(request()->routeIs('ajuda')) active @endif">
                    <i class="bi bi-question-circle me-2"></i>
                    Ajuda
                </a>

                {{-- Botão “Sair” --}}
                <form action="{{ route('logout') }}" method="POST" class="mt-3 px-2">
                    @csrf
                    <button type="submit"
                            class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Sair
                    </button>
                </form>
            </nav>
        </div>
        {{-- ========= FIM DA COLUNA LATERAL ========= --}}

        {{-- ========= COLUNA PRINCIPAL ========= --}}
        <div class="col-md-9 p-4">
            {{-- Aqui está o conteúdo que você já tinha no centro do dashboard --}}
            <h2 class="mb-4">Minha conta</h2>

            <div class="row">
                {{-- “Meus dados” --}}
                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h5 class="mb-3">Meus dados</h5>
                        <form action="{{ route('minha-conta.update') }}" method="POST">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', Auth::user()->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nome completo --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome completo*</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', Auth::user()->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gênero --}}
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gênero*</label>
                                <select id="gender"
                                        name="gender"
                                        class="form-select @error('gender') is-invalid @enderror"
                                        required>
                                    <option disabled selected>Selecione</option>
                                    <option value="masculino" @if(old('gender', Auth::user()->gender) === 'masculino') selected @endif>Masculino</option>
                                    <option value="feminino"  @if(old('gender', Auth::user()->gender) === 'feminino')  selected @endif>Feminino</option>
                                    <option value="outro"      @if(old('gender', Auth::user()->gender) === 'outro')      selected @endif>Outro</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Data de nascimento --}}
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Data de nascimento*</label>
                                <input type="date"
                                       id="birthdate"
                                       name="birthdate"
                                       class="form-control @error('birthdate') is-invalid @enderror"
                                       value="{{ old('birthdate', Auth::user()->birthdate?->format('Y-m-d')) }}"
                                       required>
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CPF --}}
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF*</label>
                                <input type="text"
                                       id="cpf"
                                       name="cpf"
                                       class="form-control @error('cpf') is-invalid @enderror"
                                       value="{{ old('cpf', Auth::user()->cpf) }}"
                                       required>
                                @error('cpf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <p class="small text-muted mt-3">
                                Ao prosseguir, declaro ter ciência de que este cadastro é somente para maiores de 18 anos.
                            </p>
                        </form>
                    </div>
                </div>

                {{-- “Meu endereço e contato” --}}
                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h5 class="mb-3">Meu endereço e contato</h5>
                        <form action="{{ route('minha-conta.update') }}" method="POST">
                            @csrf

                            {{-- CEP --}}
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text"
                                       id="cep"
                                       name="cep"
                                       class="form-control @error('cep') is-invalid @enderror"
                                       value="{{ old('cep', Auth::user()->address->cep ?? '') }}"
                                       placeholder="00000-000"
                                       required>
                                @error('cep')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Estado e Cidade --}}
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">Estado*</label>
                                    <input type="text"
                                           id="state"
                                           name="state"
                                           class="form-control @error('state') is-invalid @enderror"
                                           value="{{ old('state', Auth::user()->address->state ?? '') }}"
                                           placeholder="SP"
                                           required>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="city" class="form-label">Cidade*</label>
                                    <input type="text"
                                           id="city"
                                           name="city"
                                           class="form-control @error('city') is-invalid @enderror"
                                           value="{{ old('city', Auth::user()->address->city ?? '') }}"
                                           placeholder="São Paulo"
                                           required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Telefone --}}
                            <div class="mb-3 d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <label for="phone" class="form-label">Telefone*</label>
                                    <input type="text"
                                           id="phone"
                                           name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', Auth::user()->phone) }}"
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="button"
                                        class="btn btn-link text-danger ms-2 mt-4 p-0"
                                        onclick="document.getElementById('phone').removeAttribute('disabled');">
                                    Editar
                                </button>
                            </div>

                            {{-- Checkbox “Exibir meu telefone no anúncio” --}}
                            <div class="form-check mb-3">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="show_phone"
                                       name="show_phone"
                                       {{ old('show_phone', Auth::user()->show_phone) ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_phone">
                                    Exibir meu telefone no anúncio
                                </label>
                            </div>

                            <small class="text-muted">
                                Uma vez alterado o número de celular, a próxima alteração só poderá ser feita após 24 horas.
                            </small>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Botão "Salvar alterações" fixo ao final da coluna principal --}}
            <div class="text-end">
                <form action="{{ route('minha-conta.update') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">
                        Salvar alterações
                    </button>
                </form>
            </div>
        </div>
        {{-- ========= FIM DA COLUNA PRINCIPAL ========= --}}
    </div>
</div>
@endsection
