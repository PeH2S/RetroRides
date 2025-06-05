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

.filtros input[type="checkbox"] {
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
}

.location-modal .close {
    float: right;
    font-size: 28px;
    cursor: pointer;
    color: #333
}

.location-modal h5,
.location-modal-content p {
    color: #333;
}
.location-modal-content button{
    color: #013746;

}
.location-modal-content button:hover{
    background-color: #013746;

}
</style>
<section class="hero-section">
    <div class="hero-content mx-auto">
        <div class="filtros d-flex justify-content-center mb-3">
            <label class="filtro-item">
                <input type="checkbox" checked>
                <span>0 km</span>
            </label>
            <label class="filtro-item">
                <input type="checkbox" checked>
                <span>Usados</span>
            </label>
            <label class="filtro-item">
                <input type="checkbox">
                <span>Apenas com financiamento</span>
            </label>
        </div>

        <div class="search-bar d-flex justify-content-center">
            <form action="{{ route('search.cars') }}" method="GET" class="search-box">
                @php $location = session('user_location'); @endphp

                @if ($location)
                    <input type="hidden" name="localizacao" value="{{ $location['latitude'] }},{{ $location['longitude'] }}x100km">
                    <input type="hidden" name="estadocidade" value="{{ $location['estado'] }}-{{ $location['cidade'] }}">
                @endif

                <input type="text" name="q" class="search-input" placeholder="Busque por marca e modelo">
                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <p id="user-location-text" class="mt-4 text-white" style="cursor: pointer;">
            <i class="bi bi-geo-alt-fill"></i>
            {{ $location ? $location['cidade'] . ' ' . $location['estado'] : 'Localização Atual' }}
        </p>

        <!-- Modal de localização -->
        <div id="location-modal" class="location-modal">
            <div class="location-modal-content">
                <span class="close">&times;</span>
                <h5>Defina a localização</h5>
                <input type="text" class="form-control mb-3" id="cep-input"placeholder="Digite o seu CEP ou cidade">
                <p id="cep-resultado" class="mt-2 text-muted"></p>
                <div>
                    <p><strong>Pesquisar por</strong></p>
                    <button type="button" class="btn btn-outline-dark w-100 mb-2" id="usar-geolocalizacao">
                        <i class="bi bi-geo-alt-fill"></i> Localização atual
                    </button>
                    <button type="button" class="btn btn-outline-dark w-100">
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

    locationText.addEventListener("click", () => {
        modal.style.display = "block";
    });

    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

    geoBtn.addEventListener("click", () => {
        if (!navigator.geolocation) {
            return console.warn("Geolocalização não suportada.");
        }

        navigator.geolocation.getCurrentPosition(async (position) => {
            const { latitude: lat, longitude: lon } = position.coords;

            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
                const data = await response.json();
                const cidade = data.address.city || data.address.town || data.address.village || '';
                const estado = data.address.state || '';

                if (cidade || estado) {
                    locationText.innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${cidade} - ${estado}`;
                }
                modal.style.display = "none";
            } catch (err) {
                console.error("Erro ao obter localização:", err);
            }
        }, (err) => {
            console.warn("Permissão negada:", err.message);
        });
    });
});
</script>

<script src="{{ asset('js/cep/apiCorreios.js') }}"></script>
@yield('scripts')
