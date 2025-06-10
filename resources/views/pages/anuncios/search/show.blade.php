@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
  <div class="row">
    {{-- Carousel de fotos --}}
    <div class="col-md-8">
      <div id="anuncioCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach($anuncio->fotos as $i => $foto)
            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
              <img src="{{ asset('storage/'.$foto->path) }}" class="d-block w-100" alt="Foto {{ $i+1 }}">
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#anuncioCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#anuncioCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>

      {{-- Detalhes do veículo --}}
      <h2 class="mt-3">{{ $anuncio->titulo }}</h2>
      <h4 class="text-danger">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</h4>
      <p><i class="bi bi-geo-alt-fill"></i> {{ $anuncio->cidade }} - {{ $anuncio->estado }}</p>
      <ul class="list-inline">
        <li class="list-inline-item"><i class="bi bi-speedometer2"></i> {{ $anuncio->km }} km</li>
        <li class="list-inline-item"><i class="bi bi-calendar"></i> {{ $anuncio->ano }}</li>
        <li class="list-inline-item"><i class="bi bi-fuel-pump"></i> {{ $anuncio->combustivel }}</li>
      </ul>

      {{-- Mapa --}}
      <div class="mt-4">
        <iframe 
          src="https://www.google.com/maps?q={{ $anuncio->lat }},{{ $anuncio->lng }}&output=embed" 
          width="100%" height="300" style="border:0;" allowfullscreen=""
        ></iframe>
      </div>
    </div>

    {{-- Sidebar do vendedor --}}
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <img src="{{ asset('storage/'.$anuncio->user->avatar) }}" class="rounded-circle mb-2" width="80">
          <h5>{{ $anuncio->user->name }}</h5>
          <a href="tel:{{ $anuncio->user->phone }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
            <i class="bi bi-telephone-fill"></i> Ligar
          </a>
          <a href="#" class="btn btn-primary btn-sm w-100">
            <i class="bi bi-chat-dots-fill"></i> Chat
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
