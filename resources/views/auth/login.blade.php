<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login • RetroRides</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/stylesHome.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="min-width:320px;">
      <h4 class="card-title text-center mb-4">Entrar no RetroRides</h4>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input id="email"
                 name="email"
                 type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}"
                 required
                 autofocus>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input id="password"
                 name="password"
                 type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 required>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox"
                 name="remember"
                 id="remember"
                 class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">Lembrar-me</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Entrar</button>

        @if (Route::has('password.request'))
          <div class="text-center mt-3">
            <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
          </div>
        @endif
      </form>
    </div>
  </div>
</body>
</html>
