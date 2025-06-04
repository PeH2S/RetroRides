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
        </div>
    </div>
</nav>
