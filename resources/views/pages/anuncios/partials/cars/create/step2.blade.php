@extends('static.layoutHome')

@section('main')

<div class="container my-5">
    @include('pages.anuncios.partials.steps', ['step' => 2])

    <h2 class="text-center fw-bold mb-4">Complete as informações do seu veículo</h2>

    <form action="{{ route('anuncio.step2') }}" method="POST">
        @csrf

        <div class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 700px;">
            <!-- Quilometragem -->
            <div class="mb-4">
                <label for="quilometragem" class="form-label fw-semibold">Quilometragem*</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="quilometragem" name="quilometragem" required>
                    <span class="input-group-text">km</span>
                </div>
            </div>

            <!-- Placa -->
            <div class="mb-4">
                <label for="placa" class="form-label fw-semibold">Placa do veículo*</label>
                <input type="text"
                       class="form-control form-control-lg text-uppercase text-center fs-4 border-2 border-dark"
                       id="placa"
                       name="placa"
                       maxlength="8"
                       required
                       placeholder="EX: ABC1D23">
                <small class="form-text text-muted d-block text-center mt-2">
                    Digite a placa no formato correto (ex: ABC1D23).
                </small>
            </div>

            <!-- Situação  -->
            <div class="mb-4">
                <label for="situacao" class="form-label fw-semibold">Número de situação*</label>
                <select class="form-select custom-select" id="situacao" name="situacao" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="Novo">Novo</option>
                    <option value="Seminovo">Seminovo</option>
                    <option value="Usado">Usado</option>
                </select>
            </div>

            <!-- Número de Portas -->
            <div class="mb-4">
                <label for="portas" class="form-label fw-semibold">Número de portas*</label>
                <select class="form-select" id="portas" name="portas" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="2">2 portas</option>
                    <option value="3">3 portas</option>
                    <option value="4">4 portas</option>
                    <option value="5">5 portas</option>
                </select>
            </div>

            <!-- Descrição com contador -->
            <div class="mb-4">
                <label for="descricao" class="form-label fw-semibold">Descrição (opcional)</label>
                <textarea class="form-control"
                          id="descricao"
                          name="descricao"
                          rows="3"
                          maxlength="500"
                          placeholder="Escreva uma descrição opcional..."></textarea>
                <div class="text-end text-muted small mt-1">
                    <span id="char-count">0</span> / 500
                </div>
                <small class="text-muted">
                    Aqui você pode falar um pouco mais sobre os diferenciais do seu carro. Mas não é obrigatório, tá?
                </small>
            </div>

            <!-- Alerta de segurança -->
            <div class="alert alert-warning small d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>
                    Atenção: <strong>informações pessoais não são permitidas</strong> no campo de descrição por questões de segurança e políticas antifraude.
                </div>
            </div>

            <!-- Preço FIPE -->
            @if ($precoFipe)
                <div class="mb-4 p-3 rounded text-center" style="background-color: #f0f5f5; border: 1px solid #cde;">
                    <div class="text-muted mb-1">Preço médio FIPE</div>
                    <div class="fs-3 fw-bold text-primary">
                        R$ {{ number_format($precoFipe, 2, ',', '.') }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning small">
                    Não foi possível obter o preço FIPE para esse veículo.
                </div>
            @endif

            <!-- Preço -->
            <div class="mb-4">
                <label for="preco" class="form-label fw-semibold">Preço*</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="number" class="form-control" id="preco" name="preco" required>
                    <span class="input-group-text">,00</span>
                </div>
            </div>
            <!-- Localização -->
            <div class="mb-4">
                <label for="localizacao" class="form-label fw-semibold">Localização do veículo*</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt-fill text-danger"></i></span>
                    <input type="text" class="form-control" id="localizacao" name="localizacao" placeholder="Ex: São Paulo - SP" required>
                    <button type="button" class="btn btn-outline-secondary" id="btn-localizar">Detectar</button>
                </div>
                <small class="form-text text-muted">Clique em "Detectar" para preencher automaticamente com sua localização.</small>
            </div>

            <!-- Navegação -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('anuncio.step1') }}" class="btn btn-outline-secondary">&larr; Voltar</a>
                <button type="submit" class="btn btn-danger">Continuar &rarr;</button>
            </div>
        </div>
    </form>
</div>

<style>
    .custom-select {
        padding: 0.65rem 1rem;
        border: 1px solid #004E64;
        border-radius: 0.375rem;
        color: #004E64;
        background-color: #f9fcfc;
        transition: border-color 0.2s ease-in-out;
    }

    .custom-select:focus {
        border-color: #004E64;
        box-shadow: 0 0 0 0.2rem rgba(0, 78, 100, 0.25);
    }

    #btn-localizar {
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    #btn-localizar:hover {
        background-color: #004E64;
        color: white;
    }

</style>

<script>
    const descricao = document.getElementById('descricao');
    const contador = document.getElementById('char-count');
    descricao.addEventListener('input', () => {
        contador.textContent = descricao.value.length;
    });

    document.getElementById('btn-localizar').addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const { latitude, longitude } = position.coords;

                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
                    const data = await response.json();

                    const cidade = data.address.city || data.address.town || data.address.village || '';
                    const estado = data.address.state || '';
                    const local = `${cidade} - ${estado}`;
                    document.getElementById('localizacao').value = local;
                } catch (err) {
                    alert('Não foi possível detectar a localização automaticamente.');
                }
            }, () => {
                alert('Permissão de localização negada.');
            });
        } else {
            alert('Geolocalização não é suportada neste navegador.');
        }
    });

</script>

@endsection