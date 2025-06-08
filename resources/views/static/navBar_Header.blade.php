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
          <a class="nav-link dropdown-toggle" href="#" id="comprarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Comprar
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="comprarDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                <div class="col-6 col-md-3 mb-3">
                  <a href="{{ route('search.cars', ['condicao[]' => 'Usado']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-search fs-2 mb-2"></i>
                    <div>Carros usados</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="{{ route('search.cars', ['condicao[]' => 'Novo']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Carros novos</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="{{ route('search.cars', ['condicao[]' => 'Usado', 'tipo' => 'moto']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Motos usadas</div>
                  </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <a href="{{ route('search.cars', ['condicao[]' => 'Novo', 'tipo' => 'moto']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
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
          <a class="nav-link dropdown-toggle" href="#" id="venderDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vender
          </a>
          <div class="dropdown-menu w-100 animate__animated animate__fadeIn" aria-labelledby="venderDropdown">
            <div class="container py-3">
              <div class="row text-center justify-content-center">
                @php
                $venderOpcoes = [
                ['icon' => 'bi-car-front', 'label' => 'Vender carro'],
                ['icon' => 'bi-bicycle', 'label' => 'Vender moto'],
                ['icon' => 'bi-tools', 'label' => 'Gerenciar anúncios'],
                ];
                @endphp

                <div class="col-6 col-md-4 mb-3">
                  <a href="{{ route('anunciar', ['tipo' => 'carro']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Vender carro</div>
                  </a>
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <a href="{{ route('anunciar', ['tipo' => 'moto']) }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Vender moto</div>
                  </a>
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <a href="{{ route('dashboard') }}" class="card-hover text-decoration-none text-dark d-block border rounded py-4 h-100">
                    <i class="bi bi-tools fs-2 mb-2"></i>
                    <div>Gerenciar anúncios</div>
                  </a>
                </div>

              </div>
            </div>
          </div>
        </li>
      </ul>

      <!-- Ações do Usuário -->
      <div class="user-actions d-flex align-items-center">
        {{-- Dropdown de login/logout --}}
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarLogin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @guest
            ENTRAR
            @else
            {{ \Illuminate\Support\Str::limit(Auth::user()->name, 15) }}
            @endguest
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarLogin">
            @guest
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
            <li><a class="dropdown-item" href="{{ route('register') }}">Registrar</a></li>
            @else
            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Meu painel</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item">Sair</button>
              </form>
            </li>
            @endguest
          </ul>
        </div>

        {{-- Ícones favoritos e mensagens --}}
        <a href="#" class="nav-link ms-3"><i class="bi bi-heart"></i></a>
        <a href="#" class="nav-link ms-3"><i class="bi bi-chat"></i></a>
      </div>
    </div>
  </div>
</nav>

<!-- Script para dropdown mobile -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.nav-item.dropdown');

    dropdowns.forEach(dropdown => {
      const toggle = dropdown.querySelector('.nav-link.dropdown-toggle');
      const menu = dropdown.querySelector('.dropdown-menu');

      if (toggle && menu) {
        toggle.addEventListener('click', function(e) {
          if (window.innerWidth < 992) {
            e.preventDefault();

            // Fecha outros dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
              if (openMenu !== menu) openMenu.classList.remove('show');
            });

            menu.classList.toggle('show');
          }
        });
      }
    });

    // Fecha dropdown ao clicar fora (mobile)
    document.addEventListener('click', function(e) {
      if (window.innerWidth < 992 && !e.target.closest('.nav-item.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });
  });
</script>