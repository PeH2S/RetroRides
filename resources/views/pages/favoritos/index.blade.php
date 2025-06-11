@extends('static.layoutHome')

@section('main')
<div class="container-fluid">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-3 bg-light border-end vh-100 p-0">
      @include('components.sidebar-menu')
    </div>

    {{-- Conteúdo principal --}}
    <div class="col-md-9 p-4">
      <h2 class="mb-4 fw-bold">Meus Anúncios Favoritos</h2>

      @if ($favoritos->isEmpty())
        <div class="alert alert-info">Você ainda não favoritou nenhum anúncio.</div>
      @else
        <div class="row g-4">
          @foreach ($favoritos as $anuncio)
            <div class="col-lg-4 d-flex">
              <div class="card-anuncio position-relative w-100">
                <div class="card-image">
                  @if ($anuncio->fotos->isNotEmpty())
                    <img src="{{ Storage::url($anuncio->fotos->first()->caminho) }}" alt="{{ $anuncio->titulo }}">
                  @else
                    <img src="https://via.placeholder.com/300x200?text=Sem+Imagem" alt="Sem imagem">
                  @endif
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $anuncio->titulo }}</h5>
                  <p class="vehicle-price text-success fw-bold">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</p>
                  <div class="vehicle-details text-muted">
                    {{ $anuncio->marca }} • {{ $anuncio->modelo }} • {{ $anuncio->ano }}
                  </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between">
                  <a href="{{ route('anuncios.show', $anuncio) }}" class="btn btn-sm btn-primary">Ver Detalhes</a>
                  <button class="btn btn-sm btn-outline-danger toggle-favorite" data-anuncio-id="{{ $anuncio->id }}">
                    <i class="bi bi-heart-fill"></i> Remover
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $favoritos->links() }}</div>
      @endif
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.toggle-favorite').forEach(function(button) {
    button.addEventListener('click', function() {
      const id = this.dataset.anuncioId;
      const token = document.querySelector('meta[name="csrf-token"]').content;
      fetch(`/anuncios/${id}/favoritar`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token }
      })
      .then(res => res.json())
      .then(data => {
        if (data.action === 'removed') {
          const card = button.closest('.col-lg-4');
          card.style.transition = 'opacity 0.3s';
          card.style.opacity = 0;
          setTimeout(() => card.remove(), 300);
        }
      });
    });
  });
});
</script>
@endpush

@endsection
