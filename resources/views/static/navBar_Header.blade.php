<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-orange" href="{{ route('home') }}">
      <span style="color: #004E64">Retro Riders</span>
    </a>

    <!-- Botão hambúrguer -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu principal -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto d-flex flex-row flex-lg-row flex-column gap-3">

        <!-- Comprar -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle"
             href="#"
             id="comprarDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            Comprar
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="comprarDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                <!-- ...cartões de opção... -->
              </div>
            </div>
          </div>
        </li>

        <!-- Vender -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle"
             href="#"
             id="venderDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            Vender
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="venderDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                <!-- ...cartões de opção... -->
              </div>
            </div>
          </div>
        </li>
      </ul>

      <!-- Ações do Usuário -->
      <ul class="navbar-nav ms-auto align-items-center">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Entrar</a>
          </li>
          @if (Route::has('register'))
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
              {{ Str::limit(Auth::user()->name, 15) }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
              <li><a class="dropdown-item" href="{{ route('dashboard') }}">Meu painel</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Sair</button>
                </form>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('favoritos.index') }}" class="nav-link ms-3" title="Meus Favoritos">
              <i class="bi bi-heart"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link ms-3" title="Chat">
              <i class="bi bi-chat"></i>
            </a>
          </li>
        @endguest
      </ul>