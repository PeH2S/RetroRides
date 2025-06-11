@extends('static.layoutHome')

@section('main')
<style>
    .anuncio-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-container {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .main-image:hover {
        transform: scale(1.02);
    }

    .thumbnail-container {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
    }

    .thumbnail:hover, .thumbnail.active {
        border-color: #004E64;
    }

    .price-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 25px;
        background: white;
        position: sticky;
        top: 20px;
    }

    .price-tag {
        font-size: 28px;
        font-weight: 700;
        color: #004E64;
    }

    .price-details {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .btn-chat {
        background-color: #004E64;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-chat:hover {
        background-color: #00394b;
        color: white;
    }

    .detail-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 25px;
        background: white;
        margin-bottom: 20px;
    }

    .detail-section {
        margin-bottom: 25px;
    }

    .detail-title {
        font-size: 22px;
        font-weight: 600;
        color: #004E64;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }

    .detail-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-icon {
        color: #004E64;
        font-size: 18px;
    }

    .detail-label {
        font-weight: 500;
        color: #555;
    }

    .detail-value {
        color: #333;
    }

    .seller-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .seller-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #004E64;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
    }

    .seller-name {
        font-weight: 600;
    }

    .seller-location {
        font-size: 14px;
        color: #666;
    }

    .modal-image {
        max-width: 100%;
        max-height: 80vh;
    }

    @media (max-width: 768px) {
        .main-image {
            height: 300px;
        }

        .detail-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="anuncio-container py-4">
    <div class="row g-4">
        <!-- Coluna da imagem e informações -->
        <div class="col-lg-8">
            <!-- Galeria de imagens -->
            <div class="gallery-container mb-4">
                <img src="{{ $anuncio->imagem_url }}" class="main-image" alt="{{ $anuncio->titulo }}" id="mainImage">

                @if($anuncio->fotos->count() > 1)
                    <div class="thumbnail-container">
                        @foreach($anuncio->fotos as $foto)
                            <img src="{{ Storage::url($foto->caminho) }}"
                                 class="thumbnail {{ $loop->first ? 'active' : '' }}"
                                 alt="Foto do veículo"
                                 onclick="changeMainImage(this, '{{ Storage::url($foto->caminho) }}')">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Informações principais -->
            <div class="detail-card">
                <h1 class="detail-title">{{ $anuncio->titulo }}</h1>

                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                            {{ $anuncio->cidade }} - {{ $anuncio->estado }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="text-muted mb-2">
                            <i class="bi bi-clock"></i>
                            Anúncio publicado em {{ $anuncio->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-title">Detalhes do veículo</h3>
                    <div class="detail-list">
                        <div class="detail-item">
                            <i class="bi bi-calendar detail-icon"></i>
                            <div>
                                <div class="detail-label">Ano</div>
                                <div class="detail-value">{{ $anuncio->ano }}</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-speedometer2 detail-icon"></i>
                            <div>
                                <div class="detail-label">Quilometragem</div>
                                <div class="detail-value">{{ number_format($anuncio->quilometragem, 0, ',', '.') }} km</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-palette detail-icon"></i>
                            <div>
                                <div class="detail-label">Cor</div>
                                <div class="detail-value">{{ $anuncio->cor }}</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-gear detail-icon"></i>
                            <div>
                                <div class="detail-label">Câmbio</div>
                                <div class="detail-value">{{ $anuncio->cambio }}</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-fuel-pump detail-icon"></i>
                            <div>
                                <div class="detail-label">Combustível</div>
                                <div class="detail-value">{{ $anuncio->combustivel }}</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <i class="bi bi-car-front detail-icon"></i>
                            <div>
                                <div class="detail-label">Portas</div>
                                <div class="detail-value">{{ $anuncio->portas }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-title">Descrição</h3>
                    <p style="white-space: pre-line;">{{ $anuncio->descricao }}</p>
                </div>

                <div class="seller-info">
                    <div class="seller-avatar">
                        {{ strtoupper(substr($anuncio->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="seller-name">{{ $anuncio->user->name }}</div>
                        <div class="seller-location">Anunciante desde {{ $anuncio->user->created_at->format('m/Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna do preço e botão -->
        <div class="col-lg-4">
            <div class="price-card">
                <div class="price-tag">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</div>
                <div class="price-details">Preço à vista</div>

                @auth
                    <form method="POST" action="{{ route('chat.store') }}">
                        @csrf
                        <input type="hidden" name="comprador_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="anunciante_id" value="{{ $anuncio->user_id }}">
                        <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                        <button type="submit" class="btn btn-chat w-100 mt-4">
                            <i class="bi bi-chat-left-text"></i> Falar com o vendedor
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 mt-4">
                        <i class="bi bi-box-arrow-in-right"></i> Faça login para conversar
                    </a>
                @endauth

                <div class="mt-4 pt-3 border-top">
                    <h5 class="mb-3">Segurança</h5>
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <i class="bi bi-shield-check text-success"></i>
                        <small>Anúncio verificado</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-credit-card text-success"></i>
                        <small>Negocie diretamente com o vendedor</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para imagem ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="" class="modal-image" id="modalImage">
            </div>
        </div>
    </div>
</div>

<script>
    // Troca a imagem principal ao clicar nas miniaturas
    function changeMainImage(thumbnail, imageUrl) {
        document.getElementById('mainImage').src = imageUrl;

        // Remove a classe 'active' de todas as miniaturas
        document.querySelectorAll('.thumbnail').forEach(item => {
            item.classList.remove('active');
        });

        // Adiciona a classe 'active' na miniatura clicada
        thumbnail.classList.add('active');
    }

    // Abre a imagem em um modal ao clicar nela
    document.getElementById('mainImage').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        document.getElementById('modalImage').src = this.src;
        modal.show();
    });
</script>

@endsection
