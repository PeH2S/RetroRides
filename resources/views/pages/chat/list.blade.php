@extends('static.layoutHome')

@section('main')
    <style>
        .chat-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 16px;
            background-color: white;
            transition: 0.2s ease;
        }

        .chat-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .chat-avatar {
            width: 48px;
            height: 48px;
            background-color: #004E64;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-3 bg-white border-end min-vh-100 p-0">
                @include('components.sidebar-menu')
            </div>

            {{-- Conteúdo principal --}}
            <div class="col-md-9 p-4">
                <h2 class="mb-4 fw-bold text-dark">Meus Chats</h2>

                @if ($conversas->isEmpty())
                    <div class="text-center mt-5">
                        <img src="{{ asset('images/empty-chat.png') }}" alt="Sem conversas" style="max-width: 200px;">
                        <p class="mt-3 text-muted">Você ainda não iniciou nenhuma conversa.</p>
                        <a href="{{ route('search.index') }}" class="btn btn-outline-custom">Buscar veículos</a>
                    </div>
                @else
                    <div class="row">
                        @foreach ($conversas as $conversa)
                            @php
                                $usuarioLogado = auth()->user();
                                $souComprador = $conversa->comprador_id === $usuarioLogado->id;
                                $outroUsuario = $souComprador ? $conversa->anunciante : $conversa->comprador;
                                $papel = $souComprador ? 'Chat como comprador' : 'Chat como anunciante';
                            @endphp

                            <div class="col-md-6 mb-4">
                                <a href="{{ route('conversas.show', $conversa->id) }}" class="text-decoration-none text-dark">
                                    <div class="chat-card d-flex gap-3 align-items-center">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center chat-avatar">
                                            {{ strtoupper($outroUsuario->name[0]) }}
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>{{ $outroUsuario->name }}</strong>
                                                <span class="badge bg-secondary">{{ $papel }}</span>
                                            </div>
                                            <small class="text-muted">Anúncio: {{ $conversa->anuncio->titulo }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
