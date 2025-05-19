@extends('static.layoutHome')
@section('main')
<div class="container mt-4">
    @include('pages.anuncios.partials.steps', ['step' => 4])

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <p>Adicione até 8 fotos do veículo:</p>
        @for ($i = 0; $i < 8; $i++)
            <div class="mb-3">
                <input type="file" name="fotos[]" class="form-control">
            </div>
        @endfor
        <button type="submit" class="btn btn-success float-end">Finalizar Anúncio</button>
    </form>
</div>
@endsection
