@extends('static.layoutHome')

@section('main')
<div class="container-fluid">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-3 bg-light border-end vh-100 p-0">
      @include('components.sidebar-menu')
    </div>

    {{-- Conteúdo --}}
    <div class="col-md-9 p-4">

      @if($tab === 'overview')
        <h1 class="mb-4">Bem-vindo, {{ $user->name }}!</h1>

        <div class="row gy-4">
          {{-- Meus Dados --}}
          <div class="col-lg-6">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="mb-3">Meus Dados</h5>
              <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Nome completo</label>
                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Gênero</label>
                <input type="text" class="form-control" value="{{ $user->gender ?? '—' }}" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Data de nascimento</label>
                <input type="text" class="form-control"
                       value="{{ optional($user->birthdate)->format('d/m/Y') ?? '—' }}"
                       readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" value="{{ $user->cpf ?? '—' }}" readonly>
              </div>
            </div>
          </div>

          {{-- Endereço e Contato --}}
          <div class="col-lg-6">
            <div class="bg-white p-4 rounded shadow-sm">
              <h5 class="mb-3">Endereço e Contato</h5>
              <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" value="{{ $user->cep ?? '—' }}" readonly>
              </div>
              <div class="row g-2 mb-3">
                <div class="col-md-4">
                  <label class="form-label">Estado</label>
                  <input type="text" class="form-control" value="{{ $user->state ?? '—' }}" readonly>
                </div>
                <div class="col-md-8">
                  <label class="form-label">Cidade</label>
                  <input type="text" class="form-control" value="{{ $user->city ?? '—' }}" readonly>
                </div>
              </div>

              {{-- Telefone apenas se show_phone == true --}}
              @if($user->show_phone)
                <div class="mb-3">
                  <label class="form-label">Telefone</label>
                  <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                </div>
              @else
                <div class="mb-3">
                  <label class="form-label">Telefone</label>
                  <input type="text" class="form-control" value="—" readonly>
                </div>
              @endif

              <div class="form-check">
                <input class="form-check-input" type="checkbox" disabled
                       {{ $user->show_phone ? 'checked' : '' }}>
                <label class="form-check-label">Exibir telefone</label>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <a href="{{ route('dashboard.account') }}" class="btn btn-primary">
            Editar meus dados
          </a>
        </div>

      @elseif($tab === 'account')
        <h1 class="mb-4">Minha Conta</h1>
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @include('pages.partials.account-form')
      @endif

    </div>
  </div>
</div>
@endsection
