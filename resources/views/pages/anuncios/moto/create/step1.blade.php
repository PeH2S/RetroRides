{{-- resources/views/pages/anuncios/cars/create/step1.blade.php --}}
@extends('static.layoutHome')

@section('main')

<div class="container mt-4">
    {{-- Inclui a barra de etapas (passo 1 ativo) --}}
    @include('pages.anuncios.partials.steps', ['step' => 1])

    <!-- Formulário Centralizado e Estreito -->
    <div class="d-flex justify-content-center">
        <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 600px;">
            <h4 class="text-center mb-4">Preencha os dados do veículo</h4>

            {{-- OBS: O action aqui deve apontar para o POST da etapa 1 --}}
            <form id="form-anuncio" action="{{ route('anuncio.step1Post', ['tipoVeiculo' => session('anuncio.tipo_veiculo')]) }}" method="POST">
                @csrf
                <div class="row g-3">

                    {{-- Marca --}}
                    <div class="col-12">
                        <label for="marca" class="form-label">Marca*</label>
                        <select class="form-select @error('marca') is-invalid @enderror"
                                id="marca"
                                name="marca"
                                required>
                            <option selected disabled>Carregando...</option>
                        </select>
                        @error('marca')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Modelo --}}
                    <div class="col-12">
                        <label for="modelo" class="form-label">Modelo*</label>
                        <select class="form-select @error('modelo') is-invalid @enderror"
                                id="modelo"
                                name="modelo"
                                required
                                disabled>
                            <option selected disabled>Selecione uma marca primeiro</option>
                        </select>
                        @error('modelo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ano do Modelo / Ano de Fabricação lado a lado --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ano_modelo" class="form-label">Ano do Modelo*</label>
                            <select class="form-select @error('ano_modelo') is-invalid @enderror"
                                    id="ano_modelo"
                                    name="ano_modelo"
                                    required
                                    disabled>
                                <option selected disabled>Selecione o modelo</option>
                            </select>
                            @error('ano_modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ano_fabricacao" class="form-label">Ano de Fabricação*</label>
                            <select class="form-select @error('ano_fabricacao') is-invalid @enderror"
                                    id="ano_fabricacao"
                                    name="ano_fabricacao"
                                    required
                                    disabled>
                                <option selected disabled>Selecione o modelo</option>
                            </select>
                            @error('ano_fabricacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Combustível (visível) e hidden --}}
                    <div class="col-12">
                        <label for="combustivel_visivel" class="form-label">Combustível*</label>
                        <input type="text"
                               class="form-control"
                               id="combustivel_visivel"
                               readonly>
                        <input type="hidden" name="combustivel" id="combustivel">
                        @error('combustivel')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Cor --}}
                    <div class="col-12">
                        <label for="cor" class="form-label">Cor*</label>
                        <select class="form-select @error('cor') is-invalid @enderror"
                                id="cor"
                                name="cor"
                                required>
                            <option selected disabled>Selecione</option>
                            <option>Branco</option>
                            <option>Preto</option>
                            <option>Prata</option>
                            <option>Azul</option>
                            <option>Vermelho</option>
                        </select>
                        @error('cor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>

                    {{-- Aviso de revisão --}}
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-info-circle"></i>
                        Não será possível editar esses dados depois.
                        <strong>Revise com atenção.</strong>
                    </div>

                    {{-- Botões Voltar / Continuar --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('anunciar') }}" class="btn btn-outline-secondary">
                            &larr; Voltar
                        </a>
                        <button type="submit" class="btn btn-danger">
                            Continuar &rarr;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Importa seu JavaScript de API (para popular marca/modelo/anos/combustível) --}}
<script src="{{ asset('js/ad/adCreate.js') }}"></script>
@yield('scripts')

@endsection
