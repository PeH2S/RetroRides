
@extends('static.layoutHome')

@section('main')
<style>
        body {
            background-color: #f4f4f4;
        }

        .gallery img {
            width: 100%;
            border-radius: 8px;
        }

        .price-box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }


        .car-info-box {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .tag {
            background-color: #eee;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            margin-right: 5px;
            display: inline-block;
        }

        .form-simular input {
            margin-bottom: 10px;
        }

        .gallery-thumbs img {
            height: 60px;
            object-fit: cover;
            cursor: pointer;
        }

        .specs {
            font-size: 14px;
            line-height: 1.6;
        }

        .label {
            font-weight: bold;
        }
    </style>

    <div class="container mt-4 mb-5">
        <div class="row g-4">
            <!-- Galeria -->
            <div class="col-md-8">
                <div class="car-info-box">
                    <h4>Hyundai HB20 1.6 Premium (Aut) 2014</h4>
                    <p class="text-muted">Publicado em Presidente Prudente, SP</p>
                    <img src="https://via.placeholder.com/800x400?text=Foto+Principal" class="mb-3" alt="Veículo" />

                    <div class="d-flex justify-content-between gallery-thumbs">
                        @for ($i = 1; $i <= 4; $i++)
                            <img src="https://via.placeholder.com/150x80?text=Foto+{{ $i }}" class="img-thumbnail me-2" alt="Miniatura">
                        @endfor
                    </div>

                    <hr>
                    <div class="specs">
                        <p><span class="label">Ano:</span> 2014 / 2014</p>
                        <p><span class="label">Cor:</span> Vermelho</p>
                        <p><span class="label">Câmbio:</span> Automático</p>
                        <p><span class="label">Portas:</span> 4</p>
                        <p><span class="label">Autonomia estimada:</span> 12 km/l</p>
                        <p><span class="label">Atualizado em:</span> 25/05/2025</p>
                    </div>
                </div>
            </div>

            <!-- Preço e formulário -->
            <div class="col-md-4">
                <div class="price-box">
                    <h3 class="text-danger">R$ 55.900,00</h3>
                    <small class="text-muted">Preço sugerido</small>

                    <hr>
                    <form class="form-simular">
                        <input type="text" class="form-control" placeholder="Nome completo">
                        <input type="email" class="form-control" placeholder="Email">
                        <input type="tel" class="form-control" placeholder="DDD + Telefone">
                        <input type="text" class="form-control" placeholder="CPF">
                        <textarea class="form-control" rows="3" placeholder="Observações"></textarea>
                        <button type="button" class="btn btn-outline-secondary w-100 mt-2">Enviar Mensagem</button>
                    </form>
                </div>

                <div class="mt-4 car-info-box">
                    <h6>Compare os valores</h6>
                    <div class="mb-2">
                        <span class="label">Valor médio FIPE:</span> R$ 46.000,00
                    </div>
                    <div class="mb-2">
                        <span class="label">KBB (valor justo):</span> R$ 49.200,00
                    </div>
                    <a href="#" class="btn btn-outline-primary w-100 mt-2">Conferir ofertas similares</a>
                </div>
            </div>
        </div>
    </div>


    @endsection
