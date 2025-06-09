@extends('static.layoutHome')

@section('main')

@include('static.search')

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="fw-bold fs-4 mb-4 text-center">Carros mais buscados</h2>
        <div class="row g-4 justify-content-center">
            @foreach($marcasPopulares as $item)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('search.index', ['q' => $item['modelo']]) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm position-relative overflow-hidden rounded-4">
                        <img src="{{ asset('images/carros/' . $item['imagem']) }}"
                            class="card-img-top p-2 bg-light"
                            style="height: 140px; object-fit: contain;"
                            alt="{{ $item['modelo'] }}">
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-2"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                            <p class="text-white text-uppercase mb-0" style="font-size: 11px; opacity: 0.8;">
                                {{ $item['marca'] }}
                            </p>
                            <h6 class="text-white fw-bold mb-1" style="font-size: 14px;">
                                {{ $item['modelo'] }}
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold fs-3 mb-5 text-center">Mundo Retrô: Carros e Motos Clássicos</h2>
        <div class="row g-4">
            <!-- Bloco maior à esquerda -->
            <div class="col-lg-8">
                <div class="p-4 bg-white rounded shadow h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-primary">Volkswagen Fusca: O Ícone Brasileiro</h3>
                        <p class="text-muted">
                            O Fusca marcou gerações com seu design arredondado e resistência mecânica. Mesmo décadas após sua produção, ele ainda circula pelas ruas como símbolo de nostalgia e simplicidade.
                        </p>
                    </div>
                    <img src="{{ asset('images/retro/fusca.jpg') }}" alt="Fusca retrô"
                         class="img-fluid rounded mt-3">
                </div>
            </div>

            <!-- Dois blocos menores empilhados à direita -->
            <div class="col-lg-4 d-flex flex-column gap-4">
                <div class="p-4 bg-white rounded shadow h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold text-secondary">Harley-Davidson 1948</h5>
                        <p class="text-muted">
                            A clássica Panhead foi símbolo de liberdade nos EUA pós-guerra, eternizada em filmes e estilo de vida rebelde.
                        </p>
                    </div>
                    <img src="{{ asset('images/retro/harley.jpg') }}" alt="Harley retrô"
                         class="img-fluid rounded mt-2">
                </div>

                <div class="p-4 bg-white rounded shadow h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold text-secondary">Chevrolet Opala SS</h5>
                        <p class="text-muted">
                            Lançado em 1971, o Opala SS foi o primeiro esportivo nacional. Seu motor potente e visual agressivo o tornaram ícone das pistas e das ruas.
                        </p>
                    </div>
                    <img src="{{ asset('images/retro/opala.jpg') }}" alt="Opala retrô"
                         class="img-fluid rounded mt-2">
                </div>
            </div>
        </div>
    </div>
</section>



@endsection