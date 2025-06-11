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

        .thumbnail:hover,
        .thumbnail.active {
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

                    @if ($anuncio->fotos->count() > 1)
                        <div class="thumbnail-container">
                            @foreach ($anuncio->fotos as $foto)
                                <img src="{{ Storage::url($foto->caminho) }}"
                                    class="thumbnail {{ $loop->first ? 'active' : '' }}" alt="Foto do veículo"
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
                                    <div class="detail-value">{{ number_format($anuncio->quilometragem, 0, ',', '.') }} km
                                    </div>
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
                            <div class="seller-location">Anunciante desde {{ $anuncio->user->created_at->format('m/Y') }}
                            </div>
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
    <!-- Seção de Avaliações -->
    <div class="detail-card mt-4">
        <h3 class="detail-title">Avaliações do Anunciante</h3>

        <!-- Média de avaliações -->
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <span class="display-4 fw-bold">{{ number_format($anuncio->user->media_avaliacoes, 1) }}</span>
                <span class="text-muted">/5</span>
            </div>
            <div>
                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i
                            class="bi bi-star-fill {{ $i <= round($anuncio->user->media_avaliacoes) ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                </div>
                <small class="text-muted">{{ $anuncio->user->avaliacoesRecebidas->count() }} avaliações</small>
            </div>
        </div>

        <!-- Lista de avaliações -->
        <div class="avaliacoes-list">
            @forelse($anuncio->user->avaliacoesRecebidas as $avaliacao)
                <div class="avaliacao-item mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="seller-avatar me-2">
                                {{ strtoupper(substr($avaliacao->avaliador->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="seller-name">{{ $avaliacao->avaliador->name }}</div>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill {{ $i <= $avaliacao->nota ? 'text-warning' : 'text-secondary' }}"
                                            style="font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">{{ $avaliacao->created_at->format('d/m/Y') }}</small>
                    </div>
                    @if ($avaliacao->comentario)
                        <p class="mb-0">{{ $avaliacao->comentario }}</p>
                    @endif
                </div>
            @empty
                <p class="text-muted">Este anunciante ainda não possui avaliações.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ $anuncio->titulo }}</h2>
            <button id="favoriteButton" class="btn btn-outline-danger" data-anuncio-id="{{ $anuncio->id }}">
                <i class="bi {{ $anuncio->esta_favoritado ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                <span id="favoriteCount">{{ $anuncio->favoritadoPor->count() }}</span>
            </button>
        </div>


        <!-- Formulário de avaliação (mostrar apenas para compradores) -->
        @auth
            @if (auth()->user()->id !== $anuncio->user_id &&
                    !$anuncio->user->avaliacoesRecebidas()->where('avaliador_id', auth()->id())->exists())
                <div class="mt-5">
                    <h4 class="mb-3">Deixe sua avaliação</h4>
                    <form action="{{ route('avaliacoes.store', $anuncio) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nota</label>
                            <div class="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill star-select" data-value="{{ $i }}"
                                        style="cursor: pointer; font-size: 1.5rem;"></i>
                                @endfor
                                <input type="hidden" name="nota" id="nota" value="5" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentário (opcional)</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3" maxlength="500"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar avaliação</button>
                    </form>
                </div>
            @endif
        @else
            <div class="alert alert-info mt-4">
                <a href="{{ route('login') }}" class="text-primary">Faça login</a> para avaliar este anunciante.
            </div>
        @endauth
    </div>


    <style>
        .star-rating {
            color: #ffc107;
        }

        .star-select:hover {
            transform: scale(1.2);
            transition: transform 0.2s;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('favoriteButton');

            if (!button) return;

            button.addEventListener('click', function() {
                const anuncioId = button.getAttribute('data-anuncio-id');
                const icon = button.querySelector('i');
                const countSpan = document.getElementById('favoriteCount');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/anuncios/${anuncioId}/favoritar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (response.status === 401) {
                            window.location.href = '{{ route('login') }}';
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;

                        if (data.action === 'added') {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                            button.classList.add('btn-danger');
                            button.classList.remove('btn-outline-danger');
                        } else {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            button.classList.add('btn-outline-danger');
                            button.classList.remove('btn-danger');
                        }

                        countSpan.textContent = data.count;
                    })
                    .catch(error => {
                        console.error('Erro ao favoritar:', error);
                    });
            });
        });

        document.querySelectorAll('.star-select').forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.getElementById('nota').value = value;

                // Atualiza a visualização das estrelas
                document.querySelectorAll('.star-select').forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('text-warning');
                        s.classList.remove('text-secondary');
                    } else {
                        s.classList.add('text-secondary');
                        s.classList.remove('text-warning');
                    }
                });
            });
        });

        function changeMainImage(thumbnail, imageUrl) {
            document.getElementById('mainImage').src = imageUrl;

            document.querySelectorAll('.thumbnail').forEach(item => {
                item.classList.remove('active');
            });

            thumbnail.classList.add('active');
        }

        document.getElementById('mainImage').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            document.getElementById('modalImage').src = this.src;
            modal.show();
        });
    </script>

@endsection
