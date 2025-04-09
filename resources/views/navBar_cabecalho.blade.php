<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container" id="cabecalho">
        <div class="logo-container">
            <a class="navbar-brand" href="{{ route('inicio') }}">
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
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros-usados/estoque" target="_blank" rel="noreferrer">Carros usados</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros-novos/estoque" target="_blank" rel="noreferrer">Carros novos</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/motos-usadas/estoque" target="_blank" rel="noreferrer">Motos usadas</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/motos-novas/estoque" target="_blank" rel="noreferrer">Motos novas</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros/estoque?Oportunidades=Vistoriado" target="_blank" rel="noreferrer">Vistoriado</a></li>
                    </ul>
                </li>

                <!-- Vender -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarSell" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        VENDER
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarSell">
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/vender" target="_blank" rel="noreferrer">Vender carro</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/vender/moto" target="_blank" rel="noreferrer">Vender moto</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/garagem" target="_blank" rel="noreferrer">Gerenciar meu anúncio</a></li>
                        <li><a class="dropdown-item" href="https://cockpit.com.br/" target="_blank" rel="noreferrer">Plataforma revendedores</a></li>
                    </ul>
                </li>

                <!-- Serviços -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarServices" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        SERVIÇOS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarServices">
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/solutions/webmotors-servicos/" target="_blank" rel="noreferrer">Webmotors Serviços <span class="badge bg-danger">NOVO</span></a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/tabela-fipe/" target="_blank" rel="noreferrer">Tabela FIPE e Webmotors</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/financiamento" target="_blank" rel="noreferrer">Financiamento</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/catalogo" target="_blank" rel="noreferrer">Catálogo 0km</a></li>
                        <li><a class="dropdown-item" href="https://www.cockpit.com.br/solutions/vistoriado" target="_blank" rel="noreferrer">Vistoriado</a></li>
                        <li><a class="dropdown-item" href="https://www.autocompara.com.br/" target="_blank" rel="noreferrer">Seguro veículo</a></li>
                    </ul>
                </li>

                <!-- Ajuda -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarHelp" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        AJUDA
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarHelp">
                        <li><a class="dropdown-item" href="https://ajuda.webmotors.com.br/hc/pt-br" target="_blank" rel="noreferrer">Para você</a></li>
                        <li><a class="dropdown-item" href="https://ajuda.cockpit.com.br/hc/pt-br" target="_blank" rel="noreferrer">Para sua loja</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/solutions/seguranca" target="_blank" rel="noreferrer">Segurança</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Ações do Usuário -->
            <div class="user-actions">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarLogin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ENTRAR
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarLogin">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="https://www.cockpit.com.br/" target="_blank" rel="noreferrer">Sou lojista</a></li>
                    </ul>
                </div>

                <a class="nav-link" href="https://www.webmotors.com.br/garagem/favoritos" target="_blank" rel="noreferrer" aria-label="Visualizar favoritos">
                    <i class="bi bi-heart"></i>
                </a>

                <a class="nav-link" href="https://www.webmotors.com.br/garagem/propostas" target="_blank" rel="noreferrer" aria-label="Visualizar chat">
                    <i class="bi bi-chat"></i>
                </a>
            </div>
        </div>
    </div>
</nav>