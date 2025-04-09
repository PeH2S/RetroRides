@extends('layoutHome')

@section('corpo')
<form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Marca</label>
        <select id="brand" name="brand_id" class="form-control" required>
            <option value="">Selecione uma marca</option>
            @foreach($brands as $brand)
                <option value="{{ $brand?->id }}">{{ $brand?->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Modelo</label>
        <select id="model" name="model_id" class="form-control" required disabled>
            <option value="">Selecione uma marca primeiro</option>
            @foreach($brands as $brand)
                @foreach($brand?->carModels as $model)
                    <option value="{{ $model?->id }}" data-brand="{{ $brand?->id }}" style="display: none;">
                        {{ $model?->name }}
                    </option>
                @endforeach
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Ano</label>
        <select id="year" name="model_year_id" class="form-control" required disabled>
            <option value="">Selecione um modelo primeiro</option>
            @foreach($brands as $brand)
                @foreach($brand->carModels as $model)
                    @foreach($model?->modelYears as $year)
                        <option value="{{ $year?->id }}" data-model="{{ $model?->id }}" style="display: none;">
                            {{ $year?->year }}
                        </option>
                    @endforeach
                @endforeach
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Localização</label>
        <textarea name="location" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Quilometragem</label>
        <input type="number" name="mileage" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Cor</label>
        <input type="text" name="color" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Fotos</label>
        <input type="file" name="images[]" multiple class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Criar Anúncio</button>
</form>

<script>
document.getElementById('brand').addEventListener('change', function () {
    const brandId = this.value;
    const modelSelect = document.getElementById('model');
    const yearSelect = document.getElementById('year');

    modelSelect.disabled = !brandId;
    yearSelect.disabled = true;
    modelSelect.value = '';
    yearSelect.value = '';

    document.querySelectorAll('#model option').forEach(option => {
        option.style.display = option.dataset.brand === brandId ? 'block' : option.value === '' ? 'block' : 'none';
    });

    document.querySelectorAll('#year option').forEach(option => {
        option.style.display = option.value === '' ? 'block' : 'none';
    });
});

document.getElementById('model').addEventListener('change', function () {
    const modelId = this.value;
    const yearSelect = document.getElementById('year');

    yearSelect.disabled = !modelId;
    yearSelect.value = '';

    document.querySelectorAll('#year option').forEach(option => {
        option.style.display = option.dataset.model === modelId ? 'block' : option.value === '' ? 'block' : 'none';
    });
});
</script>
@endsection
