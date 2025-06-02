<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Webmotors</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Seus estilos locais -->
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-expand-lg">
        <div class="w-100">
            @include('static.navBar_Header')
        </div>
    </nav>


    @yield('main')


    <!-- Rodapé -->
    @include('static.footer')

    <script>
        if (navigator.geolocation && !sessionStorage.getItem('locationSent')) {
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        try {
                            const response = await fetch('/definir-localizacao', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    latitude,
                                    longitude
                                })
                            });

                            if (response.ok) {
                                sessionStorage.setItem('locationSent', 'true');
                                location
                            .reload();
                            } else {
                                console.error('Resposta inesperada do servidor:', response.status);
                            }
                        } catch (e) {
                            console.error('Erro ao definir localização:', e);
                        }
                    },
                    (error) => {
                        console.warn('Permissão de localização negada ou erro:', error);
                    }
            );
        }
    </script>


    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
