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

    <a href="{{ route('minha-conta') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('minha-conta') ? 'active' : '' }}">
      <i class="bi bi-person me-2"></i> Minha conta
    </a>
    <div class="ms-4 mb-2">
      <a href="{{ route('minha-conta') }}" class="nav-link py-1 {{ request()->routeIs('minha-conta') ? 'text-decoration-underline' : '' }}">
        Editar dados
      </a>
      <a href="{{ route('minha-conta') }}#personalizacao" class="nav-link py-1 {{ request()->routeIs('minha-conta') && request()->getFragment() === 'personalizacao' ? 'text-decoration-underline' : '' }}">
        Personalização e dados
      </a>
    </div>

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
