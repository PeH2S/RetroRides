@extends('static.layoutHome')

@section('main')
<style>
    .rating-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .rating-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #004E64;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 1rem;
    }
    
    .star-rating {
        color: #ffc107;
        font-size: 1.25rem;
    }
    
    .rating-date {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .anuncio-link {
        color: #004E64;
        font-weight: 500;
        margin-top: 0.5rem;
        display: inline-block;
    }
    
    .anuncio-link:hover {
        text-decoration: underline;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .summary-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .average-rating {
        font-size: 3rem;
        font-weight: bold;
        color: #004E64;
    }
    
    .rating-distribution {
        margin-top: 1.5rem;
    }
    
    .progress-container {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .progress-label {
        width: 80px;
        font-size: 0.875rem;
    }
    
    .progress-bar {
        flex-grow: 1;
        height: 8px;
        background-color: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
        margin: 0 1rem;
    }
    
    .progress-fill {
        height: 100%;
        background-color: #004E64;
    }
    
    .progress-count {
        width: 40px;
        text-align: right;
        font-size: 0.875rem;
        color: #6b7280;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('components.sidebar-menu')
        </div>
        
        <div class="col-md-9">
            <h2 class="mb-4 fw-bold text-dark">Minhas Avaliações</h2>
            
            <div class="summary-card">
                <div class="d-flex align-items-center">
                    <div class="me-4">
                        <span class="average-rating">{{ number_format($mediaAvaliacoes, 1) }}</span>
                        <span class="text-muted">/5</span>
                    </div>
                    <div>
                        <div class="star-rating mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill {{ $i <= round($mediaAvaliacoes) ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                        </div>
                        <p class="text-muted mb-0">{{ $avaliacoes->total() }} avaliações recebidas</p>
                    </div>
                </div>
                
                <div class="rating-distribution">
                    @php
                        $ratingCounts = auth()->user()->avaliacoesRecebidas()
                            ->selectRaw('nota, count(*) as total')
                            ->groupBy('nota')
                            ->orderBy('nota', 'desc')
                            ->pluck('total', 'nota')
                            ->toArray();
                    @endphp
                    
                    @for($i = 5; $i >= 1; $i--)
                        <div class="progress-container">
                            <div class="progress-label">
                                {{ $i }} estrela{{ $i > 1 ? 's' : '' }}
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ isset($ratingCounts[$i]) ? ($ratingCounts[$i] / $avaliacoes->total()) * 100 : 0 }}%"></div>
                            </div>
                            <div class="progress-count">
                                {{ $ratingCounts[$i] ?? 0 }}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            
            @if($avaliacoes->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-chat-square-text text-4xl text-gray-400 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Você ainda não recebeu avaliações</h3>
                    <p class="text-gray-500 mb-4">Quando você receber avaliações dos compradores, elas aparecerão aqui.</p>
                    <a href="{{ route('anuncios.index') }}" class="btn btn-primary">Ver meus anúncios</a>
                </div>
            @else
                @foreach($avaliacoes as $avaliacao)
                    <div class="rating-card">
                        <div class="rating-header">
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($avaliacao->avaliador->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-medium mb-0">{{ $avaliacao->avaliador->name }}</h4>
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $avaliacao->nota ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="rating-date">{{ $avaliacao->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        @if($avaliacao->comentario)
                            <p class="mb-3">{{ $avaliacao->comentario }}</p>
                        @endif
                        
                        <a href="{{ route('anuncio.show', $avaliacao->anuncio_id) }}" class="anuncio-link">
                            <i class="bi bi-car-front"></i> {{ $avaliacao->anuncio->marca }} {{ $avaliacao->anuncio->modelo }}
                        </a>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $avaliacoes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection