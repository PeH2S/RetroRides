@extends('static.layoutHome')

@section('main')
<style>
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
        width: 100%;
    }

    .card-option {
        height: 200px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        cursor: pointer;
        flex-direction: column;
        padding: 20px;
        color: #004E64;
    }

    .card-option:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    .card-option-text {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-option img {
        width: 60px;
        height: auto;
    }
</style>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <h2 class="mb-5 text-center" style="color: #004E64;">Qual automóvel você deseja vender?</h2>
    <div class="row w-100" style="max-width: 600px;">
        <div class="col-6 d-flex justify-content-center align-items-center p-2">
            <a href="{{ route('anuncio.step1', ['tipoVeiculo' => 'carro']) }}" class="card-link">
                <div class="card-option w-100 d-flex justify-content-center align-items-center">
                    <div class="card-option-text">Carro</div>
                    <img src="{{ url('images/car.png') }}" alt="Ícone de carro">
                </div>
            </a>
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center p-2">
            <a href="{{ route('anuncio.step1', ['tipoVeiculo' => 'moto']) }}" class="card-link">
                <div class="card-option w-100 d-flex justify-content-center align-items-center">
                    <div class="card-option-text">Moto</div>
                    <img src="{{ url('images/capacete.png') }}" alt="Ícone de moto">
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
