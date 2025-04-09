<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Webmotors</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Seus estilos locais -->
    <link rel="stylesheet" href="{{ asset('css/teste.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-expand-lg">
        <div class="w-100">
            @include('navBar_cabecalho')
        </div>
    </nav>

    <!-- Barra de Busca -->
    <div class="container mt-5">
        @include('barraBusca')
    </div>

    <!-- Listagem de Veículos -->
    <div class="container mt-5">
        @yield('corpo')
    </div>

    <!-- Rodapé -->
    @include('rodape')

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @auth
    <script>
        (async () => {
            const token = localStorage.getItem('jwt_token');

            if (!token) {
                window.location.href = "{{ route('login.form') }}";
                return;
            }

            try {
                const response = await fetch("{{ route('auth.perfil') }}", {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error('Token inválido');
                }

                const user = await response.json();
                console.log('Usuário logado:', user.name);

            } catch (error) {
                console.error(error);
                localStorage.removeItem('jwt_token');
                window.location.href = "{{ route('login.form') }}";
            }
        })();
    </script>
    @endauth
</body>

</html>
