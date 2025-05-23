@extends('static.layoutHome')

@section('main')

<div class="container mt-4">
    @include('pages.anuncios.partials.steps', ['step' => 1])


    <!-- Formulário Centralizado e Estreito -->
    <div class="d-flex justify-content-center">
        <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 600px;">
            <h4 class="text-center mb-4">Preencha os dados do veículo</h4>

            <form id="form-anuncio" action="{{ route('anuncio.step1') }}" method="POST">
                @csrf
                <div class="row g-3">

                    <!-- Dados via API -->
                    <div class="col-12">
                        <label for="marca" class="form-label">Marca*</label>
                        <select class="form-select" id="marca" name="marca" required>
                            <option selected disabled>Carregando...</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="modelo" class="form-label">Modelo*</label>
                        <select class="form-select" id="modelo" name="modelo" required disabled>
                            <option selected disabled>Selecione uma marca primeiro</option>
                        </select>
                    </div>

                    <!-- Dois anos lado a lado -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ano_modelo" class="form-label">Ano do Modelo*</label>
                            <select class="form-select" id="ano_modelo" name="ano_modelo" required disabled>
                                <option selected disabled>Selecione o modelo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="ano_fabricacao" class="form-label">Ano de Fabricação*</label>
                            <select class="form-select" id="ano_fabricacao" name="ano_fabricacao" required disabled>
                                <option selected disabled>Selecione o modelo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="combustivel" class="form-label">Combustível*</label>
                        <input type="text" class="form-control" id="combustivel_visivel" readonly >
                        <input type="hidden" name="combustivel" id="combustivel">
                    </div>


                    <div class="col-12">
                        <label for="cor" class="form-label">Cor*</label>
                        <select class="form-select" id="cor" name="cor" required>
                            <option selected disabled>Selecione</option>
                            <option>Branco</option>
                            <option>Preto</option>
                            <option>Prata</option>
                            <option>Azul</option>
                            <option>Vermelho</option>
                        </select>
                    </div>

                    <!-- Blindado -->
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="blindado" name="blindado">
                            <label class="form-check-label" for="blindado">Blindado</label>
                        </div>
                    </div>

                    <!-- Aviso -->
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-info-circle"></i> Não será possível editar esses dados depois. <strong>Revise com atenção.</strong>
                    </div>

                    <!-- Ações -->
                    <div class="d-flex justify-content-between">
                        <a href="/anunciar" class="btn btn-outline-secondary">&larr; Voltar</a>
                        <button type="submit" class="btn btn-danger">Continuar &rarr;</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/ad/adCreate.js') }}"></script>
@yield('scripts')

@endsection
