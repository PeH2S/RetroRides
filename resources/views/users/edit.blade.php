@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Usuário</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" value="{{ old('cpf_cnpj', $user->cpf_cnpj) }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control">
        </div>

        <hr class="my-4">

        <h5 class="mb-3">Alterar Senha (opcional)</h5>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Nova Senha</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Confirmar Nova Senha</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
