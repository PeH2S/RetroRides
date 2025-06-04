@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Redefinir Senha</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required
                   autofocus>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            Redefinir Senha
        </button>
    </form>
</div>
@endsection
