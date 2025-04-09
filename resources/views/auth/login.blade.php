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

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/stylesCreate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-4">
                    <div class="card-header text-center bg-primary text-white rounded-top-4">
                        <h4>Entrar na Plataforma</h4>
                    </div>
                    <div class="card-body">

                        <div id="login-alert" class="alert d-none" role="alert"></div>

                        <form id="login-form">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Entrar</button>

                            <!-- Link para cadastro -->
                            <div class="text-center mt-3">
                                <a href="{{ route('users.create') }}" class="text-decoration-none">
                                    Não tenho cadastro
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('login-form');
        const alertBox = document.getElementById('login-alert');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = form.email.value;
            const password = form.password.value;

            try {
                const response = await fetch("{{ route('auth.login') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    alertBox.className = 'alert alert-success';
                    alertBox.innerText = 'Login realizado com sucesso!';
                    alertBox.classList.remove('d-none');

                    localStorage.setItem('jwt_token', data.token);

                    setTimeout(() => {
                        window.location.href = "{{ route('inicio') }}";
                    }, 1500);
                } else {
                    alertBox.className = 'alert alert-danger';
                    alertBox.innerText = data.error || 'Erro no login. Verifique as credenciais.';
                    alertBox.classList.remove('d-none');
                }

            } catch (error) {
                alertBox.className = 'alert alert-danger';
                alertBox.innerText = 'Erro na requisição.';
                alertBox.classList.remove('d-none');
            }
        });
    </script>
</body>

</html>
