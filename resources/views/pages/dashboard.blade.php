{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard • RetroRides</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">RetroRides</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-secondary">Sair</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h1>Olá, {{ Auth::user()->name }}!</h1>
    <p>Bem-vindo ao seu painel.</p>
    <!-- conteúdo do dashboard -->
  </div>
</body>
</html>
