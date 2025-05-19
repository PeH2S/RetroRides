@extends('static.layoutHome')
@section('main')
<div class="container my-5">
    @include('pages.anuncios.partials.steps', ['step' => 2])

    <h2 class="text-center fw-bold mb-3">Informe as condições do veículo</h2>
    <p class="text-center text-muted mb-4">
        Selecione os itens que representam detalhes adicionais do seu veículo para despertar a atenção dos compradores.
    </p>

    <form action="{{ route('anuncio.step2') }}" method="POST">
        @csrf

        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            @foreach(['Único Dono', 'IPVA Pago', 'Não aceito troca', 'Veículo financiado', 'Licenciado', 'Garantia de Fábrica', 'Veículo de Colecionador', 'Todas as revisões em concessionária', 'Adaptado para pessoas com deficiência'] as $item)
                <label class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <input type="checkbox" name="condicoes[]" value="{{ $item }}" class="d-none" style="color: #004E64">
                    {{ $item }}
                </label>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('anuncio.step1') }}" class="btn btn-link text-decoration-none">
                &larr; <strong>Voltar</strong>
            </a>
            <button type="submit" class="btn btn-dark px-4 py-2">
                Continuar &rarr;
            </button>
        </div>
    </form>
</div>

{{-- Estilo opcional para destacar seleção de botões --}}
<style>
    .btn-outline-secondary input[type="checkbox"]:checked + span,
    .btn-outline-secondary input[type="checkbox"]:checked {
        background-color: #000;
        color: #fff;
        border-color: #000;
    }

    .btn-outline-secondary {
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-secondary:hover {
        background-color: #f0f0f0;
    }
</style>
@endsection
