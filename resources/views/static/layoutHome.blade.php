<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Retro Riders</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">

    <!-- Seus estilos locais -->
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
</head>

<body>
    <!-- Navbar Principal -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="margin-bottom: 5em;">
        <div class="container">
            <!-- Marca -->
            <a class="navbar-brand fw-bold text-orange" href="{{ route('home') }}">
                <span style="color: #004E64">Retro Riders</span>
            </a>

            <!-- Toggle Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('search.index') }}">Comprar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('anunciar') }}">Vender</a></li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                        @if(Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ \Illuminate\Support\Str::limit(Auth::user()->name, 15) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser" style="min-width: 8rem;">
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

                        <!-- Ícone de Favoritos: agora aponta para sua rota de favoritos -->
                        <li class="nav-item">
                            <a class="nav-link ms-3" href="{{ route('favoritos.index') }}" title="Meus Favoritos">
                                <i class="bi bi-heart"></i>
                            </a>
                        </li>

                        <!-- Ícone de Chat (mantenha o href que preferir) -->
                        <li class="nav-item">
                            <a class="nav-link ms-3" href="#" title="Chat">
                                <i class="bi bi-chat"></i>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main class="pt-5 mt-3">
        @yield('main')
    </main>

    <!-- Rodapé -->
    @include('static.footer')

    <!-- Script de localização -->
    <script>
        const isSearchPage = window.location.pathname.includes('/search');

        async function handleLocation(position) {
            const { latitude, longitude } = position.coords;
            try {
                const response = await fetch('/definir-localizacao', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ latitude, longitude })
                });
                if (!response.ok) throw new Error(await response.text());
                const data = await response.json();
                if (isSearchPage) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('localizacao', `${latitude},${longitude}x100km`);
                    url.searchParams.set('estadocidade', `${data.estado}-${data.cidade}`);
                    window.location.assign(url.toString());
                }
            } catch (e) {
                console.error('Falha ao processar localização:', e);
                alert('Falha ao processar localização');
            }
        }

        if (navigator.geolocation && !sessionStorage.getItem('locationSent')) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    sessionStorage.setItem('locationSent', 'true');
                    handleLocation(position);
                },
                error => {
                    console.warn('Permissão negada ou erro ao obter localização:', error);
                    sessionStorage.setItem('locationSent', 'true');
                }
            );
        }
    </script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
