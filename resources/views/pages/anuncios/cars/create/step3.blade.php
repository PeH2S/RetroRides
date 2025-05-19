@extends('static.layoutHome')
@section('main')
<div class="container mt-4">
    @include('pages.anuncios.partials.steps', ['step' => 3])

    <form action="{{ route('anuncios.step3') }}" method="POST">
        @csrf
        <p>Selecione as condições:</p>
        @foreach(['Único Dono', 'IPVA Pago', 'Licenciado', 'Veículo de Colecionador'] as $cond)
        <div class="form-check">
            <input type="checkbox" name="condicoes[]" value="{{ $cond }}" class="form-check-input" id="cond-{{ $loop->index }}">
            <label class="form-check-label" for="cond-{{ $loop->index }}">{{ $cond }}</label>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary float-end mt-3">Próximo &rarr;</button>
    </form>
</div>
@endsection
