<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-orange" href="#">
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
