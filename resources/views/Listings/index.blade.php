@extends('layoutHome')

@section('corpo')
<div class="container">
    <h1>Editar Anúncio</h1>

    <form action="{{ route('listings.update', $listing) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Marca</label>
            <select id="brand" name="brand_id" class="form-control" required>
                <option value="">Selecione uma marca</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $listing->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Modelo</label>
            <select id="model" name="model_id" class="form-control" required>
                <option value="">Selecione uma marca primeiro</option>
                @foreach($brands as $brand)
                    @foreach($brand->carModels as $model)
                        <option value="{{ $model->id }}" data-brand="{{ $brand->id }}"
                            style="{{ $model->brand_id == $listing->brand_id ? 'display: block;' : 'display: none;' }}"
                            {{ $listing->model_id == $model->id ? 'selected' : '' }}>
                            {{ $model->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ano</label>
            <select id="year" name="model_year_id" class="form-control" required>
                <option value="">Selecione um modelo primeiro</option>
                @foreach($brands as $brand)
                    @foreach($brand->carModels as $model)
                        @foreach($model->modelYears as $year)
                            <option value="{{ $year->id }}" data-model="{{ $model->id }}"
                                style="{{ $model->id == $listing->model_id ? 'display: block;' : 'display: none;' }}"
                                {{ $listing->model_year_id == $year->id ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Atualizar Anúncio</button>
        <a href="{{ route('listings.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

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
