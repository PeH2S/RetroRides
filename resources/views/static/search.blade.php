<style>
    .hero-section {
        width: 100%;
        height: 100vh;
        background: linear-gradient(to right, #30849b, #004E64);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    .hero-content {
        max-width: 1140px;
        width: 100%;
        padding: 0 20px;
    }

    .filtros .filtro-item {
        background: #013746;
        color: #fff;
        padding: 8px 15px;
        border-radius: 8px;
        margin: 0 5px;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .filtros input[type="checkbox"],
    .filtros input[type="radio"] {
        accent-color: white;
        margin: 0;
    }

    .search-box {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        width: 100%;
        max-width: 500px;
    }

    .search-input {
        border: none;
        padding: 12px 15px;
        flex: 1;
        font-size: 16px;
    }

    .search-input:focus {
        outline: none;
    }

    .search-button {
        background: #013746;
        border: none;
        padding: 0 20px;
        color: white;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .location-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .location-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        width: 90%;
        max-width: 400px;
        border-radius: 10px;
        position: relative;
    }

    .location-modal .close {
        float: right;
        font-size: 28px;
        cursor: pointer;
        color: #333;
    }

    .location-modal h5,
    .location-modal-content p {
        color: #333;
    }

    .location-modal-content button {
        color: #013746;
    }

    .location-modal-content button:hover {
        background-color: #013746;
    }

    .filtro-item input[type="radio"]:checked+span,
    .filtro-item input[type="checkbox"]:checked+span {
        font-weight: bold;
        text-decoration: none;
    }

    .filtro-item input[type="radio"]:checked,
    .filtro-item input[type="checkbox"]:checked {
        background-color: #dc2626;
        border-color: #dc2626;
    }
</style>
<section class="hero-section">
    <div class="hero-content mx-auto">
        <form action="{{ route('search.index') }}" method="GET" id="search-form">
            @php $location = session('user_location'); @endphp

            @if ($location)
            <input type="hidden" name="localizacao" value="{{ $location['latitude'] }},{{ $location['longitude'] }}x100km">
            <input type="hidden" name="estadocidade" value="{{ $location['estado'] }}-{{ $location['cidade'] }}">
            @endif

            <div class="filtros d-flex justify-content-center mb-3 flex-wrap">
                <label class="filtro-item">
                    <input type="radio" name="tipo" value="carro" checked>
                    <span>Carros</span>
                </label>
                <label class="filtro-item">
                    <input type="radio" name="tipo" value="moto">
                    <span>Motos</span>
                </label>
                <label class="filtro-item">
                    <input type="checkbox" name="condicao[]" value="Usado">
                    <span>Usados</span>
                </label>
            </div>

            <div class="search-bar d-flex justify-content-center">
                <div class="search-box">
                    <input type="text" name="q" class="search-input" placeholder="Busque por marca e modelo">
                    <button type="submit" class="search-button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <p id="user-location-text" class="mt-4 text-white" style="cursor: pointer;">
            <i class="bi bi-geo-alt-fill"></i>
            {{ $location ? $location['cidade'] . ' ' . $location['estado'] : 'Localização Atual' }}
        </p>

        <!-- Modal de localização -->
        <div id="location-modal" class="location-modal">
            <div class="location-modal-content">
                <span class="close">&times;</span>
                <h5>Defina a localização</h5>
                <input id="cep-input" type="text" class="form-control mb-3" placeholder="00000-000">
                <button type="button" id="apply-cep" class="btn btn-primary w-100 mb-3">Aplicar CEP</button>
                <p id="cep-resultado" class="mt-2 text-muted"></p>
                <div>
                    <p><strong>Pesquisar por</strong></p>
                    <button type="button" class="btn btn-outline-dark w-100 mb-2" id="usar-geolocalizacao">
                        <i class="bi bi-geo-alt-fill"></i> Localização atual
                    </button>
                    <button type="button" class="btn btn-outline-dark w-100" id="todo-brasil">
                        <i class="bi bi-globe2"></i> Todo o Brasil
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const locationText = document.getElementById("user-location-text");
        const modal = document.getElementById("location-modal");
        const closeModal = modal.querySelector(".close");
        const geoBtn = document.getElementById("usar-geolocalizacao");
        const brasilBtn = document.getElementById("todo-brasil");
        const cepInput = document.getElementById("cep-input");
        const applyCepBtn = document.getElementById("apply-cep");
        const cepResultado = document.getElementById("cep-resultado");

        locationText.addEventListener("click", () => modal.style.display = "block");
        closeModal.addEventListener("click", () => modal.style.display = "none");
        window.addEventListener("click", e => { if (e.target === modal) modal.style.display = "none"; });

        cepInput.addEventListener("input", () => {
            let v = cepInput.value.replace(/\D/g, '').slice(0, 8);
            if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
            cepInput.value = v;
            cepResultado.textContent = '';
        });

        applyCepBtn.addEventListener("click", async () => {
            const raw = cepInput.value.replace(/\D/g, '');
            if (raw.length !== 8) {
                cepResultado.textContent = 'CEP inválido';
                return;
            }
            try {
                const res = await fetch(`https://viacep.com.br/ws/${raw}/json/`);
                const data = await res.json();
                if (data.erro) {
                    cepResultado.textContent = 'CEP não encontrado';
                    return;
                }
                const texto = `${data.localidade} - ${data.uf}`;
                locationText.innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${texto}`;
                modal.style.display = "none";
            } catch (e) {
                cepResultado.textContent = 'Erro ao buscar CEP';
            }
        });

        geoBtn.addEventListener("click", () => {
            if (!navigator.geolocation) return console.warn("Geolocalização não suportada.");
            navigator.geolocation.getCurrentPosition(async pos => {
                const { latitude: lat, longitude: lon } = pos.coords;
                try {
                    const r = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
                    const d = await r.json();
                    const city = d.address.city || d.address.town || d.address.village || '';
                    const state = d.address.state || '';
                    locationText.innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${city} - ${state}`;
                    modal.style.display = "none";
                } catch (err) {
                    console.error(err);
                }
            }, err => console.warn(err.message));
        });

        brasilBtn.addEventListener("click", () => {
            locationText.innerHTML = `<i class="bi bi-globe2"></i> Todo o Brasil`;
            modal.style.display = "none";
        });
    });
</script>

<script src="{{ asset('js/cep/apiCorreios.js') }}"></script>
@yield('scripts')
