<<<<<<< HEAD
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container" id="cabecalho">
        <div class="logo-container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Comprar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarBuy" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                        COMPRAR
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarBuy">
                        <!-- ...itens do drop-down “COMPRAR” -->
                    </ul>
                </li>

                <!-- Vender -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('anunciar-carros') }}">
                        VENDER
                    </a>
                </li>

                <!-- Serviços -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarServices" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                        SERVIÇOS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarServices">
                        <!-- ...itens do drop-down “SERVIÇOS” -->
                    </ul>
                </li>

                <!-- Ajuda -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarHelp" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                        AJUDA
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarHelp">
                        <!-- ...itens do drop-down “AJUDA” -->
                    </ul>
                </li>
            </ul>


            <!-- Ações do Usuário -->
            <div class="user-actions d-flex align-items-center">
            {{-- dropdown de login/logout --}}
            <div class="dropdown">
                <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarLogin"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >
                @guest
                    ENTRAR
                @else
                    {{ Auth::user()->name }}
                @endguest
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarLogin">
                @guest
                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Registrar</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Meu painel</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">Sair</button>
                    </form>
                    </li>
                @endguest
                </ul>

            </div>

            {{-- ícones com margem à esquerda --}}
            <a href="#" class="nav-link ms-3"><i class="bi bi-heart"></i></a>
            <a href="#" class="nav-link ms-3"><i class="bi bi-chat"></i></a>
            </div>

            </div>
=======
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-orange" href="{{ route('home') }}">
      <span style="color: #004E64">Retro Riders</span>
    </a>

    <!-- Botão hamburguer -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu principal -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto d-flex flex-row flex-lg-row flex-column gap-3">

        <!-- Comprar -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle" href="#" id="comprarDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            Comprar
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="comprarDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                <div class="col-6 col-md-3 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-search fs-2 mb-2"></i>
                    <div>Carros usados</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Carros novos</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Motos usadas</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Motos novas</div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </li>

        <!-- Vender -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle" href="#" id="venderDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            Vender
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="venderDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                <div class="col-6 col-md-4 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Vender carro</div>
                  </a>
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Vender moto</div>
                  </a>
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <a href="#" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-tools fs-2 mb-2"></i>
                    <div>Gerenciar anúncios</div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <!-- Login -->
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        <div class="dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="entrarDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">Entrar</a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="entrarDropdown">
            <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-person me-2"></i> Para você</a></li>
            <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-shop me-2"></i> Para lojista</a></li>
          </ul>
>>>>>>> 99113619514d20b0d9c910d7c41eeed93eab73a1
        </div>
      </div>
    </div>
  </div>
</nav>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.nav-item.dropdown');

    dropdowns.forEach(dropdown => {
      const toggle = dropdown.querySelector('.nav-link');
      const menu = dropdown.querySelector('.dropdown-menu');

      toggle.addEventListener('click', function (e) {
        if (window.innerWidth < 992) {
          e.preventDefault();

          // Fecha outros dropdowns abertos
          document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            if (openMenu !== menu) {
              openMenu.classList.remove('show');
            }
          });

          menu.classList.toggle('show');
        }
      });
    });

    // Fecha o dropdown ao clicar fora (mobile)
    document.addEventListener('click', function (e) {
      if (window.innerWidth < 992 && !e.target.closest('.nav-item.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });
  });
</script>
