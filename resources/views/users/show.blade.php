{{-- resources/views/users/show.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mb-3">
        &larr; Voltar
    </a>

    <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 600px; margin: 0 auto;">
        <h4 class="text-center mb-4">Detalhes do Usuário</h4>

        <div class="mb-3">
            <label class="form-label"><strong>Nome:</strong></label>
            <div class="form-control-plaintext">{{ $user->name }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>E-mail:</strong></label>
            <div class="form-control-plaintext">{{ $user->email }}</div>
        </div>

        <div class="mb-4">
            <label class="form-label"><strong>Data de Cadastro:</strong></label>
            <div class="form-control-plaintext">{{ $user->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="d-grid">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-danger">
                Editar
            </a>
        </div>
    </div>
</div>
@endsection
