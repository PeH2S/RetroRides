@extends('static.layoutHome')

@section('main')
    <div class="container py-4">
        <div class="row">
            {{-- Menu lateral --}}
            <div class="col-md-3 bg-white border-end min-vh-100 p-0">
                @include('components.sidebar-menu')
            </div>

            {{-- Conteúdo (favoritos) à direita --}}
            <div class="col-md-9">
                <h2 class="mb-4">Meus Anúncios Favoritos</h2>

                @if ($favoritos->isEmpty())
                    <div class="alert alert-info">
                        Você ainda não favoritou nenhum anúncio.
                    </div>
                @else
                    <div class="row">
                        @foreach ($favoritos as $anuncio)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if ($anuncio->fotos->isNotEmpty())
                                        <img src="{{ Storage::url($anuncio->fotos->first()->caminho) }}" class="card-img-top"
                                            alt="{{ $anuncio->titulo }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/300x200?text=Sem+Imagem" class="card-img-top"
                                            alt="Sem imagem" style="height: 200px; object-fit: cover;">
                                    @endif

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $anuncio->titulo }}</h5>
                                        <p class="card-text text-success fw-bold">
                                            R$ {{ number_format($anuncio->preco, 2, ',', '.') }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $anuncio->marca }} • {{ $anuncio->modelo }} • {{ $anuncio->ano }}
                                            </small>
                                        </p>
                                    </div>

                                    <div class="card-footer bg-white">
                                        <a href="{{ route('anuncios.show', $anuncio) }}" class="btn btn-sm btn-primary">
                                            Ver Detalhes
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger toggle-favorite"
                                            data-anuncio-id="{{ $anuncio->id }}">
                                            <i class="bi bi-heart-fill"></i> Remover
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $favoritos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-favorite').forEach(function(button) {
                button.addEventListener('click', function() {
                    const anuncioId = button.getAttribute('data-anuncio-id');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    fetch(`/anuncios/${anuncioId}/favoritar`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.action === 'removed') {
                                const card = button.closest('.col-md-4');
                                card.style.transition = 'opacity 0.3s';
                                card.style.opacity = 0;

                                setTimeout(() => {
                                    card.remove();
                                }, 300);
                            }
                        });
                });
            });
        });
    </script>

@endsection
