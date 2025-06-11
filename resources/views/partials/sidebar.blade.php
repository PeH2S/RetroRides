<aside class="sidebar bg-light border-end vh-100">
  <div class="text-center py-4">
    <div class="rounded-circle bg-secondary text-white mx-auto mb-2" style="width: 60px; height: 60px; line-height: 60px; font-size: 24px;">
      {{ strtoupper(Auth::user()->name[0]) }}
    </div>
    <strong class="d-block">{{ Auth::user()->name }}</strong>
    <small class="text-muted">{{ Auth::user()->email }}</small>
  </div>

  <nav class="nav flex-column px-2">
    <a href="{{ route('search.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('search.index') ? 'active' : '' }}">
      <i class="bi bi-search me-2"></i> Buscar veículo
    </a>
    <a href="{{ route('anunciar') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('anunciar') ? 'active' : '' }}">
      <i class="bi bi-cash-stack me-2"></i> Vender meu veículo
    </a>
    <a href="{{ route('anuncios.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('anuncios.*') ? 'active' : '' }}">
      <i class="bi bi-megaphone me-2"></i> Meus anúncios
    </a>
    <a href="{{ route('chat.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('chat.*') ? 'active' : '' }}">
      <i class="bi bi-chat-dots me-2"></i> Chat
    </a>
    <a href="{{ route('favoritos.index') }}" class="nav-link d-flex align-items-center w-100 py-2 {{ request()->routeIs('favoritos.index') ? 'active' : '' }}">
        <i class="bi bi-heart me-2"></i>Meus Favoritos
    </a>
    <a href="{{ route('alertas.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('alertas.*') ? 'active' : '' }}">
      <i class="bi bi-bell me-2"></i> Alertas
    </a>
    <a href="{{ route('financiamento.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('financiamento.*') ? 'active' : '' }}">
      <i class="bi bi-currency-dollar me-2"></i> Financiamento
    </a>

    <!-- Minha conta com collapse -->
    <li class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse"
        href="#minhaContaSubmenu"
        role="button"
        aria-expanded="{{ request()->routeIs('minha-conta*') ? 'true' : 'false' }}"
        aria-controls="minhaContaSubmenu">
        <span><i class="bi bi-person me-2"></i> Minha conta</span>
        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse {{ request()->routeIs('minha-conta*') ? 'show' : '' }}" id="minhaContaSubmenu">
        <nav class="nav flex-column ms-3">
        <a class="nav-link py-1 {{ request()->routeIs('minha-conta') ? 'active' : '' }}"
            href="{{ route('minha-conta') }}">
            Editar dados
        </a>
        <a class="nav-link py-1 {{ request()->routeIs('minha-conta.update') ? 'active' : '' }}"
            href="{{ route('minha-conta') }}">
            Personalização e dados
        </a>
        </nav>
    </div>
    </li>

    <a href="{{ route('ajuda') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('ajuda') ? 'active' : '' }}">
      <i class="bi bi-question-circle me-2"></i> Ajuda
    </a>

    <form action="{{ route('logout') }}" method="POST" class="mt-3 px-2">
      @csrf
      <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
        <i class="bi bi-box-arrow-right me-2"></i> Sair
      </button>
    </form>
  </nav>
</aside>
