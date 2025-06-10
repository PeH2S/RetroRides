<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login • RetroRides</title>

  <!-- Bootstrap e Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
      background-color: #004E64;
      border-color: #004E64;
    }

    .btn-primary:hover {
      background-color: #003746;
      border-color: #003746;
    }

    .btn-google {
      border: 1px solid #ddd;
      background-color: #fff;
      color: #444;
      transition: 0.2s;
    }

    .btn-google:hover {
      background-color: #f1f1f1;
    }

    .form-label {
      font-weight: 500;
    }

    a {
      color: #004E64;
    }

    a:hover {
      color: #003746;
    }

    .divider {
      text-align: center;
      margin: 1.5rem 0;
      color: #888;
      font-size: 0.9rem;
      position: relative;
    }

    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      width: 40%;
      height: 1px;
      background: #ddd;
      top: 50%;
    }

    .divider::before {
      left: 0;
    }

    .divider::after {
      right: 0;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 w-100" style="max-width: 380px;">
      <h4 class="text-center mb-4" style="color:#004E64;">RetroRides</h4>

      {{-- Google Login --}}
      <a href="{{ route('login.google') }}" class="btn btn-google w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
        <i class="fab fa-google"></i> Entrar com Google
      </a>

      <div class="divider">ou use seu e-mail</div>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input id="email" name="email" type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}" required autofocus>
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

        <div class="mb-3 form-check">
          <input type="checkbox" name="remember" id="remember" class="form-check-input"
                 {{ old('remember') ? 'checked' : '' }}>
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
