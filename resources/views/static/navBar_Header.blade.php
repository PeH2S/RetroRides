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
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros-usados/estoque" target="_blank" rel="noreferrer"> <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#000000"><path d="M240-200v40q0 17-11.5 28.5T200-120h-40q-17 0-28.5-11.5T120-160v-320l84-240q6-18 21.5-29t34.5-11h440q19 0 34.5 11t21.5 29l84 240v320q0 17-11.5 28.5T800-120h-40q-17 0-28.5-11.5T720-160v-40H240Zm-8-360h496l-42-120H274l-42 120Zm-32 80v200-200Zm100 160q25 0 42.5-17.5T360-380q0-25-17.5-42.5T300-440q-25 0-42.5 17.5T240-380q0 25 17.5 42.5T300-320Zm360 0q25 0 42.5-17.5T720-380q0-25-17.5-42.5T660-440q-25 0-42.5 17.5T600-380q0 25 17.5 42.5T660-320Zm-460 40h560v-200H200v200Z"/></svg>Carros usados</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros-novos/estoque" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#000000"><path d="M320-704 200-824l56-56 120 120-56 56Zm320 0-56-56 120-120 56 56-120 120Zm-200-56v-200h80v200h-80ZM160 0q-17 0-28.5-11.5T120-40v-320l84-240q6-18 21.5-29t34.5-11h440q19 0 34.5 11t21.5 29l84 240v320q0 17-11.5 28.5T800 0h-40q-17 0-28.5-11.5T720-40v-40H240v40q0 17-11.5 28.5T200 0h-40Zm72-440h496l-42-120H274l-42 120Zm68 240q25 0 42.5-17.5T360-260q0-25-17.5-42.5T300-320q-25 0-42.5 17.5T240-260q0 25 17.5 42.5T300-200Zm360 0q25 0 42.5-17.5T720-260q0-25-17.5-42.5T660-320q-25 0-42.5 17.5T600-260q0 25 17.5 42.5T660-200Zm-460 40h560v-200H200v200Zm0 0v-200 200Z"/></svg> Carros novos</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/motos-usadas/estoque" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#000000"><path d="M428-520h-70 150-80ZM200-200q-83 0-141.5-58.5T0-400q0-83 58.5-141.5T200-600h464l-80-80H440v-80h143q16 0 30.5 6t25.5 17l139 139q78 6 130 63t52 135q0 83-58.5 141.5T760-200q-83 0-141.5-58.5T560-400q0-18 2.5-35.5T572-470L462-360h-66q-14 70-69 115t-127 45Zm560-80q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm-560 0q38 0 68.5-22t43.5-58H200v-80h112q-13-36-43.5-58T200-520q-50 0-85 35t-35 85q0 50 35 85t85 35Zm198-160h30l80-80H358q15 17 25 37t15 43Z"/></svg>Motos usadas</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/motos-novas/estoque" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#000000"><path d="M160-200q-66 0-113-47T0-360q0-57 36.5-101t93.5-55l-28-24H0v-60h180l100 60 160-60h126l-62-80H400v-80h142l84 108 134-68v120h-92l70 92q15-6 30.5-9t31.5-3q66 0 113 47t47 113q0 66-47 113t-113 47q-66 0-113-47t-47-113q0-27 9.5-52.5T676-460l-20-24-136 204H400l-80-70q-5 63-51 106.5T160-200Zm0-80q33 0 56.5-23.5T240-360q0-33-23.5-56.5T160-440q-33 0-56.5 23.5T80-360q0 33 23.5 56.5T160-280Zm294-240-144 54 144-54h130-130Zm346 240q33 0 56.5-23.5T880-360q0-33-23.5-56.5T800-440q-33 0-56.5 23.5T720-360q0 33 23.5 56.5T800-280Zm-322-80 106-160H454l-144 54 120 106h48Z"/></svg> Motos novas</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/carros/estoque?Oportunidades=Vistoriado" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#000000"><path d="m424-318 282-282-56-56-226 226-114-114-56 56 170 170ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm280-590q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>Vistoriado</a></li>
                    </ul>
                </li>

                <!-- Vender -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarSell" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        VENDER
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarSell">
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/vender" target="_blank" rel="noreferrer"><i class="material-icons">car_repair</i>Vender carro</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/vender/moto" target="_blank" rel="noreferrer"><i class="material-icons">build</i>Vender moto</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/garagem" target="_blank" rel="noreferrer"><i class="material-icons">manage_accounts</i>Gerenciar meu anúncio</a></li>
                        <li><a class="dropdown-item" href="https://cockpit.com.br/" target="_blank" rel="noreferrer"><i class="material-icons">business_center</i>Plataforma revendedores</a></li>
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
                        <li><a class="dropdown-item" href="https://ajuda.webmotors.com.br/hc/pt-br" target="_blank" rel="noreferrer"><i class="material-icons">help</i>Para você</a></li>
                        <li><a class="dropdown-item" href="https://ajuda.cockpit.com.br/hc/pt-br" target="_blank" rel="noreferrer"><i class="material-icons">store</i>Para sua loja</a></li>
                        <li><a class="dropdown-item" href="https://www.webmotors.com.br/solutions/seguranca" target="_blank" rel="noreferrer"><i class="material-icons">security</i>Segurança</a></li>
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
