{{-- resources/views/pages/account/index.blade.php --}}
@extends('pages.dashboard') {{-- estendendo o layout usado no seu Dashboard --}}

@section('title', 'Minha Conta')

@section('content')
<div class="container py-5">
    <h1>Minha conta</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('minha-conta.update') }}" method="POST">
        @csrf

        <div class="row gx-4">
            {{-- CARD 1: Meus dados --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Meus dados</h5>
                        <small class="text-muted">Campos com asterisco (*) são obrigatórios</small>
                    </div>
                    <div class="card-body">
                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nome completo --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome completo *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gênero --}}
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gênero *</label>
                            <select id="gender"
                                    name="gender"
                                    class="form-select @error('gender') is-invalid @enderror"
                                    required>
                                <option value="" disabled {{ old('gender', $user->gender) ? '' : 'selected' }}>Selecione</option>
                                <option value="masculino"  {{ old('gender', $user->gender) == 'masculino'  ? 'selected' : '' }}>Masculino</option>
                                <option value="feminino"   {{ old('gender', $user->gender) == 'feminino'   ? 'selected' : '' }}>Feminino</option>
                                <option value="outro"       {{ old('gender', $user->gender) == 'outro'       ? 'selected' : '' }}>Outro</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Data de nascimento --}}
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Data de nascimento *</label>
                            <input type="date"
                                   id="birthdate"
                                   name="birthdate"
                                   class="form-control @error('birthdate') is-invalid @enderror"
                                   value="{{ old('birthdate', \Carbon\Carbon::parse($user->birthdate ?? now())->format('Y-m-d')) }}"
                                   required>
                            @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CPF --}}
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF *</label>
                            <input type="text"
                                   id="cpf"
                                   name="cpf"
                                   class="form-control @error('cpf') is-invalid @enderror"
                                   value="{{ old('cpf', $user->cpf) }}"
                                   placeholder="000.000.000-00"
                                   required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <p class="small text-muted mt-3">
                            Ao prosseguir, declaro ter ciência de que este cadastro é apenas para maiores de 18 anos.
                        </p>
                    </div>
                </div>
            </div>

            {{-- CARD 2: Meu endereço e contato --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Meu endereço e contato</h5>
                        <small class="text-muted">Campos com asterisco (*) são obrigatórios</small>
                    </div>
                    <div class="card-body">
                        {{-- CEP --}}
                        <div class="mb-3">
                            <label for="cep" class="form-label">CEP *</label>
                            <input type="text"
                                id="cep"
                                name="cep"
                                class="form-control @error('cep') is-invalid @enderror"
                                value="{{ old('cep', $user->address->cep ?? '') }}"
                                placeholder="00000-000"
                                required>
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estado / Cidade --}}
                        <div class="row gx-2">
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">Estado *</label>
                                <input type="text"
                                    id="state"
                                    name="state"
                                    class="form-control @error('state') is-invalid @enderror"
                                    value="{{ old('state', $user->address->state ?? '') }}"
                                    placeholder="SP"
                                    required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="city" class="form-label">Cidade *</label>
                                <input type="text"
                                    id="city"
                                    name="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ old('city', $user->address->city ?? '') }}"
                                    placeholder="São Paulo"
                                    required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Telefone --}}
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-grow-1">
                                <label for="phone" class="form-label">Telefone *</label>
                                <input type="text"
                                       id="phone"
                                       name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="(11) 99999-0000"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="form-text text-muted mt-1">
                                    Uma vez alterado o número de celular, a próxima alteração só poderá ser feita após 24 horas.
                                </small>
                            </div>
                            <div class="ms-3 align-self-end">
                                <button type="button" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </button>
                            </div>
                        </div>

                        {{-- Checkbox “Exibir meu telefone no anúncio” --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="show_phone"
                                   name="show_phone" {{ old('show_phone', $user->show_phone ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_phone">
                                Exibir meu telefone no anúncio
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Salvar alterações
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- fim row gx-4 --}}
    </form>
</div>
@endsection
