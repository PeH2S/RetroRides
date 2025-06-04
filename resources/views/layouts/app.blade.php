{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Título padrão; cada view pode sobrescrever com @section('title') --}}
    <title>@yield('title', 'RetroRides')</title>

    {{-- ===== Bootstrap 5 (CSS) ===== --}}
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoWiYIFl0nCJn0n/XN0xFl/+EZAbO1uVHJk5qUI0yJGSmXE"
      crossorigin="anonymous"
    >

    {{-- ===== Bootstrap Icons (opcional) ===== --}}
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    >

    {{-- Aqui você pode adicionar CSS extra (ex.: <link rel="stylesheet" href="{{ asset('css/app.css') }}">) --}}
    @stack('styles')
</head>
<body class="bg-light">

    {{-- ================= Navbar Global ================= --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">RetroRides</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Links à esquerda --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anuncios-carros') }}">Anúncios</a>
                    </li>
                </ul>

                {{-- Links à direita --}}
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a
                              id="navbarDropdown"
                              class="nav-link dropdown-toggle"
                              href="#"
                              role="button"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">Perfil</a>
                                <hr class="dropdown-divider">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- ================= Conteúdo Principal ================= --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- ===== Bootstrap 5 (JS bundle: Popper + JS) ===== --}}
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENv9gE+CE5iBlYz00R1hZ6MPJ+z21OBmIFbkB6e60rSBX1F5BrUKVul-XLhR8J2K"
      crossorigin="anonymous"
    ></script>

    {{-- JS extra --}}
    @stack('scripts')
</body>
</html>
