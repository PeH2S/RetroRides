<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container" id="cabecalho">
        <div class="logo-container">
            <a class="navbar-brand" href="/home">
                <img src="{{ url('images/logo.png') }}" alt="Logo" class="logo-img">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Principal -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Comprar -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarBuy" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        COMPRAR
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarBuy">
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/carros-usados/estoque?lkid=1000" target="_blank"
                                rel="noreferrer">Carros usados</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/carros-novos/estoque?lkid=1001" target="_blank"
                                rel="noreferrer">Carros novos</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/motos-usadas/estoque?lkid=1002" target="_blank"
                                rel="noreferrer">Motos usadas</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/motos-novas/estoque?lkid=1003" target="_blank"
                                rel="noreferrer">Motos novas</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/carros/estoque?Oportunidades=Vistoriado&amp;lkid=1576"
                                target="_blank" rel="noreferrer">Vistoriado</a></li>
                    </ul>
                </li>

                <!-- Vender -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarSell" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        VENDER
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarSell">
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/vender?lkid=1006" target="_blank"
                                rel="noreferrer">Vender carro</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/vender/moto?lkid=1007" target="_blank"
                                rel="noreferrer">Vender moto</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/garagem?lkid=1009" target="_blank"
                                rel="noreferrer">Gerenciar meu anúncio</a></li>
                        <li><a class="dropdown-item dropdown-item-custom" href="https://cockpit.com.br/?lkid=1017"
                                target="_blank" rel="noreferrer">Plataforma revendedores</a></li>
                    </ul>
                </li>

                <!-- Serviços -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarServices" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        SERVIÇOS
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarServices">
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/solutions/webmotors-servicos/?lkid=2473"
                                target="_blank" rel="noreferrer">Webmotors Serviços <span
                                    class="badge-new">NOVO</span></a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/tabela-fipe/?lkid=1010" target="_blank"
                                rel="noreferrer">Tabela FIPE e Tabela Webmotors</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/financiamento?lkid=1011" target="_blank"
                                rel="noreferrer">Financiamento</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/catalogo?lkid=1012" target="_blank"
                                rel="noreferrer">Catálogo 0km</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.cockpit.com.br/solutions/vistoriado?lkid=1577" target="_blank"
                                rel="noreferrer">Vistoriado</a></li>
                        <li><a class="dropdown-item dropdown-item-custom" href="https://cockpit.com.br/?lkid=1017"
                                target="_blank" rel="noreferrer">Plataforma revendedores</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.autocompara.com.br/?lkid=1015&amp;utm_source=webmotors&amp;utm_medium=site&amp;utm_campaign=menu_servicos_seguro_veiculo"
                                target="_blank" rel="noreferrer">Seguro veículo</a></li>
                    </ul>
                </li>

                <!-- Ajuda -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarHelp" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        AJUDA
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarHelp">
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://ajuda.webmotors.com.br/hc/pt-br?lkid=1018" target="_blank"
                                rel="noreferrer">Para você</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://ajuda.cockpit.com.br/hc/pt-br?lkid=1019" target="_blank"
                                rel="noreferrer">Para sua loja</a></li>
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="https://www.webmotors.com.br/solutions/seguranca?lkid=2173" target="_blank"
                                rel="noreferrer">Segurança</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Ações do Usuário -->
            <div class="user-actions">

                <!-- Login Dropdown -->
                <div class="dropdown">
                    <a class="nav-link user-action-icon dropdown-toggle" href="#" id="navbarLogin" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        ENTRAR
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom" aria-labelledby="navbarLogin">
                        <li><a class="dropdown-item dropdown-item-custom"
                                href="/usuarios/cadastro    " target="_self"
                                rel="noreferrer">Login</a></li>
                        <li><a class="dropdown-item dropdown-item-custom" href="https://www.cockpit.com.br/?lkid=1365"
                                target="_blank" rel="noreferrer">Sou lojista</a></li>
                    </ul>
                </div>
                <!-- Favoritos -->
                <a class="nav-link user-action-icon" href="https://www.webmotors.com.br/garagem/favoritos?lkid=1366"
                    target="_blank" rel="noreferrer" aria-label="Visualizar favoritos">
                    <i class="bi bi-heart"></i>
                </a>

                <!-- Mensagens -->
                <a class="nav-link user-action-icon"
                    href="https://www.webmotors.com.br/garagem/propostas?nps=true&amp;lkid=1367" target="_blank"
                    rel="noreferrer" aria-label="Visualizar chat">
                    <i class="bi bi-chat"></i>
                </a>
            </div>
        </div>
    </div>
</nav>