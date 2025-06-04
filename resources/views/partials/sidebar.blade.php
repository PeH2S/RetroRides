{{-- resources/views/partials/sidebar.blade.php --}}
<aside class="sidebar bg-light border-end vh-100">
    <div class="sidebar-header text-center py-4">
        {{-- Avatar: inicial do usuário --}}
        <div class="avatar rounded-circle bg-secondary text-white mx-auto mb-2" style="width: 60px; height: 60px; line-height: 60px; font-size: 24px;">
            {{ strtoupper(Auth::user()->name[0]) }}
        </div>
        {{-- Nome e e-mail --}}
        <div class="user-info">
            <strong class="d-block">{{ Auth::user()->name }}</strong>
            <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
    </div>

    <nav class="nav flex-column px-2">
        {{-- Procurar veículo --}}
        <a href="{{ route('anuncios-carros') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('anuncios-carros')) active @endif">
            <i class="bi bi-search me-2"></i>
            Buscar veículo
        </a>

        {{-- Vender meu veículo --}}
        <a href="{{ route('anunciar') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('anunciar')) active @endif">
            <i class="bi bi-cash-stack me-2"></i>
            Vender meu veículo
        </a>

        {{-- Meus anúncios --}}
        <a href="{{ route('anuncios.index') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('anuncios.*')) active @endif">
            <i class="bi bi-megaphone me-2"></i>
            Meus anúncios
        </a>

        {{-- Chat --}}
        <a href="{{ route('chat.index') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('chat.*')) active @endif">
            <i class="bi bi-chat-dots me-2"></i>
            Chat
        </a>

        {{-- Favoritos --}}
        <a href="{{ route('favoritos.index') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('favoritos.*')) active @endif">
            <i class="bi bi-heart me-2"></i>
            Favoritos
        </a>

        {{-- Alertas --}}
        <a href="{{ route('alertas.index') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('alertas.*')) active @endif">
            <i class="bi bi-bell me-2"></i>
            Alertas
        </a>

        {{-- Financiamento --}}
        <a href="{{ route('financiamento.index') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('financiamento.*')) active @endif">
            <i class="bi bi-currency-dollar me-2"></i>
            Financiamento
        </a>

        {{-- Minha conta (item pai) --}}
        <a href="{{ route('minha-conta') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('minha-conta')) active @endif">
            <i class="bi bi-person me-2"></i>
            Minha conta
        </a>
        {{-- Submenu de “Minha conta” --}}
        <div class="ms-4 mb-2">
            <a href="{{ route('minha-conta') }}" class="nav-link py-1 @if(request()->routeIs('minha-conta')) text-decoration-underline @endif">
                Editar dados
            </a>
            <a href="{{ route('minha-conta') }}#personalizacao" class="nav-link py-1 @if(request()->routeIs('minha-conta') && request()->getFragment() === 'personalizacao') text-decoration-underline @endif">
                Personalização e dados
            </a>
        </div>

        {{-- Ajuda --}}
        <a href="{{ route('ajuda') }}" class="nav-link d-flex align-items-center @if(request()->routeIs('ajuda')) active @endif">
            <i class="bi bi-question-circle me-2"></i>
            Ajuda
        </a>

        {{-- Sair --}}
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-box-arrow-right me-2"></i>
                Sair
            </button>
        </form>
    </nav>
</aside>

{{-- Pequeno CSS inline para a sidebar (você pode mover para seu app.css) --}}
<style>
.sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
}
.sidebar-header {
    border-bottom: 1px solid #ddd;
}
.nav-link {
    color: #495057;
}
.nav-link.active {
    background-color: #e9ecef;
    font-weight: 500;
}
</style>
