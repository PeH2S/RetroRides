<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Retro Riders</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Seus estilos locais -->
  <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">

  <!-- Hover personalizado para o navbar (depois dos outros CSS) -->
  <style>
    .navbar-nav .nav-link {
      color: #555 !important;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color .2s, color .2s;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #004E64 !important;
      background-color: #e6f2f4 !important;
    }
  </style>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">

  <!-- Pusher & Echo -->
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
</head>

<body>
  <!-- Navbar Principal -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="margin-bottom: 5em;">
    <div class="container">
      <!-- Marca -->
      <a class="navbar-brand fw-bold text-orange" href="{{ route('home') }}">
        <span style="color: #004E64">Retro Riders</span>
      </a>

      <!-- Toggle Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('search.index') ? 'active' : '' }}"
               href="{{ route('search.index') }}">
              Comprar
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('anunciar') ? 'active' : '' }}"
               href="{{ route('anunciar') }}">
              Vender
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto align-items-center">
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Entrar</a>
            </li>
            @if(Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registrar</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"
                 href="#"
                 id="navbarUser"
                 role="button"
                 data-bs-toggle="dropdown"
                 aria-expanded="false">
                {{ \Illuminate\Support\Str::limit(Auth::user()->name, 15) }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser" style="min-width: 8rem;">
                <li>
                  <a class="dropdown-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                    Dashboard
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ request()->routeIs('dashboard.account') ? 'active' : '' }}"
                     href="{{ route('dashboard.account') }}">
                    Minha Conta
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Sair</button>
                  </form>
                </li>
              </ul>
            </li>

            <!-- Favoritos -->
            <li class="nav-item">
              <a class="nav-link ms-3 {{ request()->routeIs('favoritos.index') ? 'active' : '' }}"
                 href="{{ route('favoritos.index') }}"
                 title="Meus Favoritos">
                <i class="bi bi-heart"></i>
              </a>
            </li>

            <!-- Chat -->
            <li class="nav-item">
              <a class="nav-link ms-3 {{ request()->routeIs('chat.index') ? 'active' : '' }}"
                 href="{{ route('chat.index') }}"
                 title="Chat">
                <i class="bi bi-chat"></i>
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <main class="pt-5 mt-3">
    @yield('main')
  </main>

  <!-- Rodapé -->
  @include('static.footer')

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>
