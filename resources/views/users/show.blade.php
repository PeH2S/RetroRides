@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detalhes do Usuário</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefone:</strong> {{ $user->phone }}</p>
            <p><strong>CPF/CNPJ:</strong> {{ $user->cpf_cnpj }}</p>
            <p><strong>Endereço:</strong> {{ $user->address }}</p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Voltar para a Lista</a>
</div>
@endsection
