@extends('static.layoutHome')

@section('main')
<style>
    .material-icons {
        font-size: 1.25rem;
        vertical-align: middle;
    }
    .breadcrumb-link {
        color: #4b5563;
    }
    .breadcrumb-link:hover {
        color: #1f2937;
    }
    .filter-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
    }
    .btn-primary {
        background-color: #ef4444;
        color: white;
        border-radius: 0.375rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #dc2626;
    }
    .btn-secondary {
        background-color: #e5e7eb;
        color: #1f2937;
        border-radius: 0.375rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .btn-secondary:hover {
        background-color: #d1d5db;
    }
    .input-text {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 3rem;
        height: 1.5rem;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 1.5rem;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 1.125rem;
        width: 1.125rem;
        left: 0.1875rem;
        bottom: 0.1875rem;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #ef4444;
    }
    input:checked + .slider:before {
        transform: translateX(1.5rem);
    }
    .product-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }
    .product-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .sponsored-tag {
        background-color: #fef3c7;
        color: #b45309;
        font-size: 0.75rem;
        padding: 0.125rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }
    .btn-view-offer {
        background-color: #374151;
        color: white;
        font-weight: 500;
        padding: 0.75rem 0;
        text-align: center;
        transition: background-color 0.3s ease;
    }
    .btn-view-offer:hover {
        background-color: #1f2937;
    }
    .btn-view-parcels {
        background-color: #10b981;
        color: white;
        font-weight: 500;
        padding: 0.75rem 0;
        text-align: center;
        transition: background-color 0.3s ease;
        border-radius: 0.375rem;
    }
    .btn-view-parcels:hover {
        background-color: #059669;
    }
    .favorite-icon {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 0.25rem;
        cursor: pointer;
    }
    .favorite-icon:hover {
        background-color: white;
    }
</style>

<div class="container mx-auto px-4 py-8">
    <nav class="mb-6 text-sm">
        <a class="breadcrumb-link" href="#">Home</a>
        <span class="mx-1 text-gray-400">/</span>
        <a class="breadcrumb-link" href="#">Carros Usados</a>
        <span class="mx-1 text-gray-400">/</span>
        <a class="breadcrumb-link" href="#">SP</a>
        <span class="mx-1 text-gray-400">/</span>
        <span class="text-gray-600 font-medium">São Paulo</span>
    </nav>

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Carros usados e seminovos em {{$location['cidade']}} - {{$location['estado']}} </h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filtros -->
        <aside class="lg:col-span-1">
            <div class="filter-card">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Filtros aplicados
                        <span class="bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0.5 ml-1">1</span>
                    </h2>
                    <button class="text-sm text-red-500 hover:text-red-700 font-medium">Limpar todos</button>
                </div>

                <div class="bg-gray-100 p-2 rounded-md flex items-center justify-between text-sm text-gray-700 mb-6">
                    <span>São Paulo - SP</span>
                    <button class="text-gray-500 hover:text-gray-700">
                        <span class="material-icons text-base">close</span>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="flex border border-gray-300 rounded-md">
                        <button class="flex-1 py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-l-md border-r border-gray-300 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:z-10">
                            <span class="material-icons mr-1 text-lg">directions_car</span> Carros
                        </button>
                        <button class="flex-1 py-2 px-4 text-sm font-medium text-gray-500 hover:bg-gray-50 rounded-r-md flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:z-10">
                            <span class="material-icons mr-1 text-lg">two_wheeler</span> Motos
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="location">Localização</label>
                    <div class="relative">
                        <input class="input-text w-full pr-10" id="location" name="location" type="text" value="São Paulo - SP"/>
                        <span class="material-icons absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">close</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="distance">Alcance da busca</label>
                    <div class="flex justify-between text-sm text-gray-500 mb-2">
                        <span>0 Km</span>
                        <span class="text-red-500 font-medium">100 Km</span>
                        <span>500 Km</span>
                    </div>
                    <input class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-500" id="distance" max="500" min="0" name="distance" type="range" value="100"/>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-3">O que é interessante para você?</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm text-gray-600" for="inspected">Vistoriado</label>
                                <p class="text-xs text-gray-400">Seminovos com laudo de vistoria</p>
                            </div>
                            <label class="switch">
                                <input id="inspected" type="checkbox"/>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm text-gray-600" for="360view">Visão 360°</label>
                                <p class="text-xs text-gray-400">Explore cada detalhe do veículo</p>
                            </div>
                            <label class="switch">
                                <input id="360view" type="checkbox"/>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm text-gray-600" for="super-price">Super Preço</label>
                                <p class="text-xs text-gray-400">Veículos com preço abaixo da média</p>
                            </div>
                            <label class="switch">
                                <input checked id="super-price" type="checkbox"/>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t pt-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Condição do Veículo</h3>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input class="form-checkbox h-4 w-4 text-red-500 border-gray-300 rounded focus:ring-red-400" type="checkbox"/>
                            <span class="text-sm text-gray-600">Novo</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input class="form-checkbox h-4 w-4 text-red-500 border-gray-300 rounded focus:ring-red-400" type="checkbox"/>
                            <span class="text-sm text-gray-600">Usado</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6 border-t pt-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Ano</h3>
                    <div class="flex space-x-2">
                        <input class="input-text w-1/2 text-sm" placeholder="De" type="number"/>
                        <input class="input-text w-1/2 text-sm" placeholder="Até" type="number"/>
                    </div>
                </div>

                <button class="w-full btn-primary mt-8">Ver Ofertas</button>
            </div>
        </aside>

        <!-- Lista de Anúncios -->
        <main class="lg:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-gray-600">{{ $anuncios->total() }} anúncios encontrados</p>
                <div class="flex items-center">
                    <label class="text-sm text-gray-600 mr-2" for="sort">Ordenar Por:</label>
                    <select class="input-text text-sm py-1.5" id="sort" name="sort">
                        <option>Mais relevantes</option>
                        <option>Menor preço</option>
                        <option>Maior preço</option>
                        <option>Mais novos</option>
                    </select>
                </div>
            </div>

            @if ($anuncios->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-gray-600">Nenhum anúncio encontrado para sua busca.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($anuncios as $anuncio)
                        <div class="product-card">
                            <div class="relative">
                                <img alt="{{ $anuncio->marca }} {{ $anuncio->modelo }}"
                                     class="w-full h-48 object-cover"
                                     src="{{ $anuncio->imagem ?? 'https://via.placeholder.com/300x180?text=Veiculo' }}"/>

                                @if($anuncio->patrocinado)
                                    <span class="absolute top-2 left-2 sponsored-tag">Patrocinado</span>
                                @endif

                                <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">1/{{ $anuncio->fotos_count ?? 8 }}</div>

                                <button class="favorite-icon">
                                    <span class="material-icons {{ $anuncio->favorito ? 'text-red-500' : 'text-gray-400' }}">
                                        {{ $anuncio->favorito ? 'favorite' : 'favorite_border' }}
                                    </span>
                                </button>
                            </div>

                            <div class="p-4">
                                @if($anuncio->oferta_especial)
                                    <img alt="Oferta especial" class="h-5 mb-1" src="https://via.placeholder.com/100x20?text=Oferta"/>
                                @endif

                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ strtoupper($anuncio->marca) }} {{ $anuncio->modelo }}</h3>
                                <p class="text-sm text-gray-600 mb-1">{{ $anuncio->versao }}</p>
                                <p class="text-xs text-gray-500 mb-3">
                                    {{ $anuncio->ano_modelo }} <span class="mx-1">•</span>
                                    {{ $anuncio->quilometragem ? number_format($anuncio->quilometragem, 0, ',', '.') . ' Km' : '0 Km' }}
                                </p>

                                @if(isset($anuncio->distance))
                                    <p class="text-xs text-gray-500 mb-3 flex items-center">
                                        <span class="material-icons text-sm mr-1">location_on</span>
                                        Distância: {{ round($anuncio->distance, 1) }} km
                                    </p>
                                @endif

                                <p class="text-2xl font-bold text-gray-800 mb-3">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</p>
                            </div>

                            <a href="{{ route('anuncio.show', $anuncio->id) }}" class="w-full btn-view-offer block text-center">
                                Ver oferta
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-10 flex justify-center items-center space-x-2">
                    @if ($anuncios->onFirstPage())
                        <button class="p-2 rounded-md hover:bg-gray-200 disabled:opacity-50" disabled>
                            <span class="material-icons text-gray-600">chevron_left</span>
                        </button>
                    @else
                        <a href="{{ $anuncios->previousPageUrl() }}" class="p-2 rounded-md hover:bg-gray-200">
                            <span class="material-icons text-gray-600">chevron_left</span>
                        </a>
                    @endif

                    @foreach ($anuncios->getUrlRange(1, $anuncios->lastPage()) as $page => $url)
                        @if ($page == $anuncios->currentPage())
                            <span class="px-4 py-2 text-sm font-medium rounded-md bg-red-500 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-200 text-gray-700">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($anuncios->hasMorePages())
                        <a href="{{ $anuncios->nextPageUrl() }}" class="p-2 rounded-md hover:bg-gray-200">
                            <span class="material-icons text-gray-600">chevron_right</span>
                        </a>
                    @else
                        <button class="p-2 rounded-md hover:bg-gray-200 disabled:opacity-50" disabled>
                            <span class="material-icons text-gray-600">chevron_right</span>
                        </button>
                    @endif
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
