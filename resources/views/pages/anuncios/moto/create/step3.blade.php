@extends('static.layoutHome')
@section('main')
<div class="container my-5">
    @include('pages.anuncios.partials.steps', ['step' => 3])

    <h2 class="text-center fw-bold mb-3">Informe as condições do veículo</h2>
    <p class="text-center text-muted mb-4">
        Selecione os itens que representam detalhes adicionais do seu veículo para despertar a atenção dos compradores.
    </p>

    <form action="{{ route('anuncio.step3') }}" method="POST">
        @csrf

        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            @foreach(['Único Dono', 'IPVA Pago', 'Não aceito troca', 'Veículo financiado', 'Licenciado', 'Garantia de Fábrica', 'Veículo de Colecionador', 'Todas as revisões em concessionária', 'Adaptado para pessoas com deficiência'] as $index => $item)
                <label class="btn btn-outline-success rounded-pill px-4 py-2 condicao-btn" style="color: #004E64;" for="condicao{{ $index }}">
                    <input type="checkbox" name="condicoes[]" value="{{ $item }}" class="d-none condicao-checkbox" id="condicao{{ $index }}">
                    {{ $item }}
                </label>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('anuncio.step2') }}" class="btn btn-link text-decoration-none">
                &larr; <strong>Voltar</strong>
            </a>
            <button type="submit" class="btn btn-dark px-4 py-2">
                Continuar &rarr;
            </button>
        </div>
    </form>
</div>

<style>
    .btn-outline-success {
        border-color: #004E64;
        color: #004E64;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-success:hover {
        background-color: #e6f5ec;
    }

    .btn-outline-success.selected {
        background-color: #004E64 !important;
        color: white !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.condicao-checkbox');
        const labels = document.querySelectorAll('.condicao-btn');

        labels.forEach((label, index) => {
            label.addEventListener('click', (e) => {
                e.preventDefault();
                const checkbox = checkboxes[index];
                checkbox.checked = !checkbox.checked;
                label.classList.toggle('selected', checkbox.checked);
            });
        });
    });
</script>
@endsection