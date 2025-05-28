<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Cadastro • RetroRides</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/stylesHome.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="min-width:320px;">
      <h4 class="card-title text-center mb-4">Criar Conta</h4>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input id="name" name="name" type="text"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" required autofocus>
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input id="email" name="email" type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}" required>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input id="password" name="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 required>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirme a Senha</label>
          <input id="password_confirmation" name="password_confirmation" type="password"
                 class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Registrar</button>
        <div class="text-center mt-3">
          Já tem conta?
          <a href="{{ route('login') }}">Entrar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
