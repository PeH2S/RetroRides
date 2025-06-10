{{-- resources/views/pages/dashboard.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container-fluid">
  <div class="row">
    {{-- COLUNA LATERAL (MENU) --}}
    <div class="col-md-3 bg-light border-end vh-100 p-0">
      @include('partials.sidebar')
    </div>

    {{-- COLUNA PRINCIPAL (Conteúdo das páginas filhas) --}}
    <div class="col-md-9 p-4">
      @yield('content')
    </div>
  </div>
</div>
@endsection
