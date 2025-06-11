<style>
  a.nav-link {
    color: #555;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 8px;
  }

  .nav-link.active {
    color: #004E64 !important;
    background-color: #e6f2f4;
  }

  .nav-link:hover {
    background-color: #f4f4f4;
  }
</style>

<div class="text-center py-4 border-bottom">
  <div
    class="rounded-circle text-white mx-auto mb-2 sidebar-avatar d-flex justify-content-center align-items-center"
    style="background-color: #004E64; width: 60px; height: 60px; line-height: 60px; font-size: 24px;">
    {{ strtoupper(Auth::user()->name[0]) }}
  </div>
  <strong class="d-block">{{ Auth::user()->name }}</strong>
  <small class="text-muted">{{ Auth::user()->email }}</small>
</div>

<nav class="nav flex-column px-3 py-3">
  <a href="{{ route('search.index') }}"
    class="nav-link @if(request()->routeIs('search.index')) active @endif">
    <i class="bi bi-search me-2"></i> Buscar veículo
  </a>

  <a href="{{ route('anunciar') }}"
    class="nav-link @if(request()->routeIs('anunciar')) active @endif">
    <i class="bi bi-cash-stack me-2"></i> Vender meu veículo
  </a>

  <a href="{{ route('anuncios.index') }}"
    class="nav-link @if(request()->routeIs('anuncios.*')) active @endif">
    <i class="bi bi-megaphone me-2"></i> Meus anúncios
  </a>

  <a href="{{ route('chat.index') }}"
    class="nav-link @if(request()->routeIs('chat.*')) active @endif">
    <i class="bi bi-chat-dots me-2"></i> Chat
  </a>

  <a href="{{ route('favoritos.index') }}"
    class="nav-link @if(request()->routeIs('favoritos.index')) active @endif">
    <i class="bi bi-heart me-2"></i> Meus Favoritos
  </a>
  <a href="{{ route('avaliacoes.minhas') }}" class="nav-link @if(request()->routeIs('avaliacoes.*')) active @endif">
    <i class="bi bi-star me-2"></i> Minhas Avaliações
  </a>

  <!-- Minha Conta -->
  <a href="{{ route('dashboard.account') }}"
    class="nav-link @if(request()->routeIs('dashboard.account')) active @endif">
    <i class="bi bi-person me-2"></i> Minha Conta
  </a>
  <div class="ms-4">
    <a href="{{ route('dashboard.account') }}"
      class="nav-link py-1 text-muted">
      Editar dados
    </a>
  </div>

  <form action="{{ route('logout') }}" method="POST" class="px-3 mt-3">
    @csrf
    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
      <i class="bi bi-box-arrow-right me-2"></i> Sair
    </button>
  </form>
</nav>