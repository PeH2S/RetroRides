{{-- resources/views/users/create.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    <div class="d-flex justify-content-center">
        <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 600px;">
            <h4 class="text-center mb-4">Criar Usuário</h4>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                {{-- Nome --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome*</label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Digite o nome completo"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- E-mail --}}
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail*</label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="exemplo@dominio.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Senha --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Senha*</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Digite uma senha"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirmar Senha --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Senha*</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control"
                           placeholder="Repita a senha"
                           required>
                </div>

                {{-- Botão Salvar --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-danger">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
