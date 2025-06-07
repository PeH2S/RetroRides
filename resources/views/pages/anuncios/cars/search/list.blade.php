<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Retro Riders</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" />
    <!-- Seus estilos locais -->
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesNavBar.css') }}">
</head>
    
</body>
</html>
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
            <form method="GET" action="{{ request()->url() }}">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <div class="filter-card">
                    {{-- Tipo de Veículo --}}
                    <div class="mb-6">
                        <div class="flex border border-gray-300 rounded-md">
                            <button type="submit" name="tipo" value="carro"
                                class="flex-1 py-2 px-4 text-sm font-medium {{ request('tipo') === 'carro' ? 'text-white bg-red-500' : 'text-gray-700 bg-white' }} rounded-l-md border-r border-gray-300 flex items-center justify-center">
                                <span class="material-icons mr-1 text-lg">directions_car</span> Carros
                            </button>
                            <button type="submit" name="tipo" value="moto"
                                class="flex-1 py-2 px-4 text-sm font-medium {{ request('tipo') === 'moto' ? 'text-white bg-red-500' : 'text-gray-500 hover:bg-gray-50' }} rounded-r-md flex items-center justify-center">
                                <span class="material-icons mr-1 text-lg">two_wheeler</span> Motos
                            </button>
                        </div>
                    </div>

                    {{-- Localização --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="location">Localização</label>
                        <div class="relative">
                            <input class="input-text w-full pr-10" id="location" name="location" type="text" 
                                value="{{ request('location') ?: (isset($location['cidade']) ? $location['cidade'].', '.$location['estado'] : '') }}" 
                                placeholder="Digite uma cidade ou endereço" />
                            @if(request('location') || !isset($location['cidade']))
                                <button type="submit" name="location" value="" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" title="Limpar localização" style="background:none; border:none; cursor:pointer;">
                                    <span class="material-icons">close</span>
                                </button>
                            @else
                                <button type="button" onclick="this.form.location.value=''; this.form.submit();" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" title="Usar minha localização atual" style="background:none; border:none; cursor:pointer;">
                                    <span class="material-icons">my_location</span>
                                </button>
                            @endif
                        </div>
                        @if(!request('location') && isset($location['cidade']))
                            <p class="text-xs text-gray-500 mt-1">Mostrando resultados próximos a {{ $location['cidade'] }}, {{ $location['estado'] }}</p>
                        @endif
                    </div>

                    {{-- Alcance --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="distance">Alcance da busca</label>
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>0 Km</span>
                            <span class="text-red-500 font-medium">{{ request('distance', 100) }} Km</span>
                            <span>500 Km</span>
                        </div>
                        <input class="w-full h-2 bg-gray-200 rounded-lg accent-red-500" id="distance" max="500" min="0" name="distance" type="range" value="{{ request('distance', 100) }}" />
                    </div>

                    {{-- Detalhes adicionais --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-3">O que é interessante para você?</h3>
                        <div class="space-y-3">
                            @php
                                $detalhes = request('detalhes', []);
                                function isChecked($val) {
                                    return in_array($val, request('detalhes', []));
                                }
                            @endphp
                            @foreach([
                                'Único Dono' => 'Somente um único Dono',
                                'IPVA Pago' => 'IPVA em dia',
                                'Não Aceito Troca' => 'Veículos somente venda',
                                'Licenciado' => 'Veículos Licenciados',
                                'Veículo de Colecionador' => 'Modelo de Colecionador',
                                'Todas as revisões em concessionária' => 'Veículo com a revisão em dia',
                                'Adaptado para pessoas com deficiência' => 'Veículo adaptado',
                            ] as $key => $desc)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm text-gray-600" for="{{ Str::slug($key) }}">{{ $key }}</label>
                                        <p class="text-xs text-gray-400">{{ $desc }}</p>
                                    </div>
                                    <label class="switch">
                                        <input id="{{ Str::slug($key) }}" type="checkbox" name="detalhes[]"
                                            value="{{ $key }}" {{ isChecked($key) ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Condição do veículo --}}
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4 tracking-wide">Condição do Veículo</h3>
                        <div class="space-y-3">
                            @foreach(['Novo', 'Usado', 'Seminovo'] as $condicao)
                                <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:shadow-sm transition duration-150">
                                    <input type="checkbox" name="condicao[]" value="{{ $condicao }}"
                                        class="form-checkbox h-5 w-5 text-red-600 border-gray-300 rounded"
                                        {{ in_array($condicao, request('condicao', [])) ? 'checked' : '' }} />
                                    <span class="text-sm text-gray-700">{{ $condicao }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ano de modelo --}}
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Ano</h3>
                        <div class="flex space-x-2">
                            <input class="input-text w-1/2 text-sm" name="ano_de" placeholder="De" type="number" value="{{ request('ano_de') }}" />
                            <input class="input-text w-1/2 text-sm" name="ano_ate" placeholder="Até" type="number" value="{{ request('ano_ate') }}" />
                        </div>
                    </div>

                    {{-- Botão --}}
                    <button type="submit" class="w-full btn-primary mt-8">Aplicar Filtros</button>
                </div>
            </form>
        </aside>

        <!-- Lista de Anúncios -->
        <main class="lg:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-gray-600">{{ $anuncios->total() }} anúncios encontrados</p>
                <form method="GET" action="{{ request()->url() }}" id="sortForm" class="flex items-center">
                    {{-- Mantém os filtros atuais como hidden inputs --}}
                    @foreach(request()->except('sort') as $key => $value)
                        @if(is_array($value))
                            @foreach($value as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <label class="text-sm text-gray-600 mr-2" for="sort">Ordenar Por:</label>
                    <select class="input-text text-sm py-1.5" id="sort" name="sort" onchange="document.getElementById('sortForm').submit()">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Mais relevantes</option>
                        <option value="Menor preço" {{ request('sort') == 'Menor preço' ? 'selected' : '' }}>Menor preço</option>
                        <option value="Maior preço" {{ request('sort') == 'Maior preço' ? 'selected' : '' }}>Maior preço</option>
                        <option value="Mais novos" {{ request('sort') == 'Mais novos' ? 'selected' : '' }}>Mais novos</option>
                    </select>
                </form>
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
<!-- noUiSlider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
<!-- Lodash para debounce -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const distanceSlider = document.getElementById('distance');
    if (distanceSlider) {
        noUiSlider.create(distanceSlider, {
            start: [100],
            connect: [true, false],
            range: {
                'min': 0,
                'max': 500
            },
            step: 10,
            format: {
                to: function(value) {
                    return Math.round(value);
                },
                from: function(value) {
                    return Number(value);
                }
            }
        });

        distanceSlider.noUiSlider.on('update', _.debounce(function(values) {
            updateFilters({ distance: values[0] });
        }, 500));
    }

    const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(.switch input)');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const filterName = this.id || this.name;
            const filterValue = this.checked;
            updateFilters({ [filterName]: filterValue });
        });
    });

    const switches = document.querySelectorAll('.switch input');
    switches.forEach(switchInput => {
        switchInput.addEventListener('change', function() {
            const filterName = this.id;
            const filterValue = this.checked;
            updateFilters({ [filterName]: filterValue });
        });
    });

    const yearInputs = document.querySelectorAll('input[placeholder="De"], input[placeholder="Até"]');
    yearInputs.forEach(input => {
        input.addEventListener('change', function() {
            const yearFrom = document.querySelector('input[placeholder="De"]').value;
            const yearTo = document.querySelector('input[placeholder="Até"]').value;
            updateFilters({ year_from: yearFrom, year_to: yearTo });
        });
    });

    const sortSelect = document.getElementById('sort');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            updateFilters({ sort: this.value });
        });
    }

    const clearFiltersBtn = document.querySelector('button.text-red-500');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            // Resetar todos os filtros
            window.location.href = window.location.pathname;
        });
    }

    function updateFilters(newFilters) {
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);

        if(url.searchParams.has('q')){
            searchParams.set('q', url.searchParams.get('q'));
        }

        for (const [key, value] of Object.entries(newFilters)) {
            if (value !== '' && value !== null && value !== undefined) {
                searchParams.set(key, value);
            } else {
                searchParams.delete(key);
            }
        }

        // Fazer requisição AJAX
        fetch(`${url.pathname}?${searchParams.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');

            const newList = newDoc.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.xl\\:grid-cols-3.gap-6');
            const newPagination = newDoc.querySelector('.mt-10.flex.justify-center.items-center.space-x-2');

            if (newList) {
                document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.xl\\:grid-cols-3.gap-6').innerHTML = newList.innerHTML;
            }

            if (newPagination) {
                document.querySelector('.mt-10.flex.justify-center.items-center.space-x-2').innerHTML = newPagination.innerHTML;
            }

            const resultCount = newDoc.querySelector('.text-sm.text-gray-600');
            if (resultCount) {
                document.querySelector('.text-sm.text-gray-600').textContent = resultCount.textContent;
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>

</body>

</html>
