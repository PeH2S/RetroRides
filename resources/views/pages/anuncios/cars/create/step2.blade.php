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
                <small class="text-muted">Aqui você pode falar um pouco mais sobre os diferenciais do seu carro. Mas não é obrigatório, tá?</small>
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
                <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="500" placeholder="Escreva uma descrição opcional..."></textarea>
                <div class="text-end text-muted small mt-1"><span id="char-count">0</span> / 500</div>
            </div>

            <!-- Alerta de segurança -->
            <div class="alert alert-warning small d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>
                    Atenção: <strong>informações pessoais não são permitidas</strong> no campo de descrição por questões de segurança e políticas antifraude.
                </div>
            </div>

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
            <!-- Navegação -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('anuncio.step1') }}" class="btn btn-outline-secondary">&larr; Voltar</a>
                <button type="submit" class="btn btn-danger">Continuar &rarr;</button>
            </div>
        </div>
    </form>
</div>

<script>
    const descricao = document.getElementById('descricao');
    const contador = document.getElementById('char-count');
    descricao.addEventListener('input', () => {
        contador.textContent = descricao.value.length;
    });
</script>

@endsection
