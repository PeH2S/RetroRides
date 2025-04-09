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
                            {{ $listing->model_id == $model->id ? 'selected' : '' }}
                            style="{{ $listing->brand_id == $brand->id ? 'display:block;' : 'display:none;' }}">
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
                                {{ $listing->model_year_id == $year->id ? 'selected' : '' }}
                                style="{{ $listing->model_id == $model->id ? 'display:block;' : 'display:none;' }}">
                                {{ $year->year }}
                            </option>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Preço (R$)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $listing->price }}" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-control" required>{{ $listing->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Localização</label>
            <input type="text" name="location" class="form-control" value="{{ $listing->location }}" required>
        </div>

        <div class="form-group">
            <label>Quilometragem</label>
            <input type="number" name="mileage" class="form-control" value="{{ $listing->mileage }}" required>
        </div>

        <div class="form-group">
            <label>Cor</label>
            <input type="text" name="color" class="form-control" value="{{ $listing->color }}" required>
        </div>

        <div class="form-group">
            <label>Imagens Atuais</label>
            <div class="row">
                @foreach($listing->photos as $photo)
                    <div class="col-md-3 mb-3">
                        <img src="{{ asset('storage/' . $photo->path) }}" class="img-thumbnail" style="height: 100px;">
                        <div class="form-check mt-2">
                            <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="form-check-input" id="photo_{{ $photo->id }}">
                            <label class="form-check-label" for="photo_{{ $photo->id }}">Remover</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Adicionar Novas Imagens (Máx. 5)</label>
            <input type="file" name="images[]" class="form-control-file" multiple accept="image/*">
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
