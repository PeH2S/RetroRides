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
              <div class="row text-center justify-content-center g-3">
                <div class="col-12 col-md-3">
                  <a href="{{ route('search.index', ['condicao[]'=>'Usado','tipo'=>'carro']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
                    <i class="bi bi-search fs-2 mb-2"></i>
                    <div>Carros usados</div>
                  </a>
                </div>
                <div class="col-12 col-md-3">
                  <a href="{{ route('search.index', ['condicao[]'=>'Novo','tipo'=>'carro']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Carros novos</div>
                  </a>
                </div>
                <div class="col-12 col-md-3">
                  <a href="{{ route('search.index', ['condicao[]'=>'Usado','tipo'=>'moto']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Motos usadas</div>
                  </a>
                </div>
                <div class="col-12 col-md-3">
                  <a href="{{ route('search.index', ['condicao[]'=>'Novo','tipo'=>'moto']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
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
              <div class="row text-center justify-content-center g-3">
                <div class="col-12 col-md-4">
                  <a href="{{ route('anunciar', ['tipo'=>'carro']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
                    <i class="bi bi-car-front fs-2 mb-2"></i>
                    <div>Vender carro</div>
                  </a>
                </div>
                <div class="col-12 col-md-4">
                  <a href="{{ route('anunciar', ['tipo'=>'moto']) }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
                    <i class="bi bi-bicycle fs-2 mb-2"></i>
                    <div>Vender moto</div>
                  </a>
                </div>
                <div class="col-12 col-md-4">
                  <a href="{{ route('dashboard') }}"
                     class="card-hover d-block text-decoration-none text-dark border rounded p-4 h-100">
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
      <ul class="navbar-nav ms-auto align-items-center">
        @guest
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
               href="{{ route('login') }}">
              Entrar
            </a>
          </li>
          @if(Route::has('register'))
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                 href="{{ route('register') }}">
                Registrar
              </a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('dashboard*') ? 'active' : '' }}"
               href="#"
               id="navbarUser"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>
              {{ \Illuminate\Support\Str::limit(Auth::user()->name, 15) }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarUser" style="min-width:12rem;">
              <li>
                <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                  <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('dashboard.account') ? 'active' : '' }}"
                   href="{{ route('dashboard.account') }}">
                  <i class="bi bi-person-lines-fill me-2"></i> Minha Conta
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('anuncios.index') ? 'active' : '' }}"
                   href="{{ route('anuncios.index') }}">
                  <i class="bi bi-megaphone me-2"></i> Meus Anúncios
                </a>
              </li>
              <li><hr class="dropdown-divider my-1"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center w-100">
                    <i class="bi bi-box-arrow-right me-2"></i> Sair
                  </button>
                </form>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 {{ request()->routeIs('favoritos.index') ? 'active' : '' }}"
               href="{{ route('favoritos.index') }}" title="Meus Favoritos">
              <i class="bi bi-heart"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 {{ request()->routeIs('chat.index') ? 'active' : '' }}"
               href="{{ route('chat.index') }}" title="Chat">
              <i class="bi bi-chat"></i>
            </a>
          </li>
        @endguest
      </ul>
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
            document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
              if (openMenu !== menu) openMenu.classList.remove('show');
            });
            menu.classList.toggle('show');
          }
        });
      }
    });

    document.addEventListener('click', function(e) {
      if (window.innerWidth < 992 && !e.target.closest('.nav-item.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });
  });
</script>
