@extends('layoutHome')

@section('corpo')
<form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
    @csrf
  
    <div class="form-group">
        <label>Marca</label>
        <select id="brand" class="form-control">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Modelo</label>
        <select id="model" class="form-control" disabled>
            <option value="">Selecione uma marca primeiro</option>
        </select>
    </div>

    <div class="form-group">
        <label>Ano</label>
        <select name="model_year_id" id="year" class="form-control" disabled>
            <option value="">Selecione um modelo primeiro</option>
        </select>
    </div>


    <input type="file" name="photos[]" multiple>

    <button type="submit">Publicar Anúncio</button>
</form>


<script>
document.getElementById('brand').addEventListener('change', function() {

});
</script>

@endsection
