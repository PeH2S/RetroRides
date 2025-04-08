@extends('layoutHome')

@section('corpo')
<form method="GET" action="{{ route('search.index') }}">
    <select name="brand" id="brand">
        <option value="">Todas as Marcas</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>

    <select name="model" id="model" {{ !request('brand') ? 'disabled' : '' }}>
        <option value="">Todos os Modelos</option>

    </select>

    <input type="number" name="min_price" placeholder="Preço mínimo" value="{{ request('min_price') }}">
    <input type="number" name="max_price" placeholder="Preço máximo" value="{{ request('max_price') }}">

    <input type="text" name="location" placeholder="Localização" value="{{ request('location') }}">

    <button type="submit">Buscar</button>
</form>


@foreach($listings as $listing)
    <div class="listing">
        <img src="{{ Storage::url($listing->mainPhoto()->path) }}" alt="">
        <h3>{{ $listing->modelYear->carModel->brand->name }} {{ $listing->modelYear->carModel->name }}</h3>
        <p>Ano: {{ $listing->modelYear->year }}</p>
        <p>Preço: R$ {{ number_format($listing->price, 2, ',', '.') }}</p>
        <p>Localização: {{ $listing->location }}</p>
        <a href="{{ route('listings.show', $listing) }}">Ver detalhes</a>
    </div>
@endforeach

{{ $listings->appends(request()->query())->links() }}


@endsection
