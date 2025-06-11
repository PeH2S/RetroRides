@extends('pages.dashboard')

@section('title', 'Minha Conta')

@section('content')
<div class="container py-5">
  <h1 class="mb-4">Minha Conta</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('minha-conta.update') }}" method="POST" novalidate>
    @csrf
    @method('PUT')

    <div class="row g-4">
      {{-- Card 1: Meus Dados --}}
      <div class="col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-header">
            <h5 class="mb-1">Meus Dados</h5>
            <small class="text-muted">* Campos obrigatórios</small>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="email" class="form-label">E-mail *</label>
              <input type="email" name="email" id="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email', $user->email) }}" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">Nome Completo *</label>
              <input type="text" name="name" id="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $user->name) }}" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label for="gender" class="form-label">Gênero *</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option disabled value=""{{ old('gender',$user->gender)?'':' selected' }}>Selecione</option>
                <option value="masculino"{{ old('gender',$user->gender)=='masculino'?' selected':'' }}>Masculino</option>
                <option value="feminino"{{ old('gender',$user->gender)=='feminino'?' selected':'' }}>Feminino</option>
                <option value="outro"{{ old('gender',$user->gender)=='outro'?' selected':'' }}>Outro</option>
              </select>
              @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label for="birthdate" class="form-label">Data de Nascimento *</label>
              <input type="date" name="birthdate" id="birthdate"
                     class="form-control @error('birthdate') is-invalid @enderror"
                     value="{{ old('birthdate', optional($user->birthdate)->format('Y-m-d')) }}" required>
              @error('birthdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label for="cpf" class="form-label">CPF *</label>
              <input type="text" name="cpf" id="cpf"
                     class="form-control @error('cpf') is-invalid @enderror"
                     value="{{ old('cpf', $user->cpf) }}" placeholder="000.000.000-00" required>
              @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <small class="text-muted">Ao prosseguir, declaro ter 18 anos ou mais.</small>
          </div>
        </div>
      </div>

      {{-- Card 2: Endereço e Contato --}}
      <div class="col-lg-6">
        <div class="card shadow-sm h-100">
          <div class="card-header">
            <h5 class="mb-1">Endereço e Contato</h5>
            <small class="text-muted">* Campos obrigatórios</small>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="cep" class="form-label">CEP *</label>
              <input type="text" name="cep" id="cep"
                     class="form-control @error('cep') is-invalid @enderror"
                     value="{{ old('cep', $user->address->cep ?? '') }}" placeholder="00000-000" required>
              @error('cep')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-2 mb-3">
              <div class="col-md-4">
                <label for="state" class="form-label">Estado *</label>
                <input type="text" name="state" id="state"
                       class="form-control @error('state') is-invalid @enderror"
                       value="{{ old('state', $user->address->state ?? '') }}" placeholder="SP" required>
                @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-8">
                <label for="city" class="form-label">Cidade *</label>
                <input type="text" name="city" id="city"
                       class="form-control @error('city') is-invalid @enderror"
                       value="{{ old('city', $user->address->city ?? '') }}" placeholder="São Paulo" required>
                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Telefone *</label>
              <div class="input-group">
                <input type="text" name="phone" id="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $user->phone) }}" placeholder="(00) 00000-0000" required>
                <button type="button" class="btn btn-outline-secondary" id="btn-edit-phone">Editar</button>
              </div>
              @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
              <small class="form-text text-muted mt-1">Próxima alteração só após 24h.</small>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="show_phone" name="show_phone" value="1"
                     {{ old('show_phone', $user->show_phone ?? false) ? 'checked' : '' }}>
              <label class="form-check-label" for="show_phone">Exibir meu telefone no anúncio</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Botão Salvar Alterações --}}
    <div class="mt-4 d-grid">
      <button type="submit" class="btn btn-danger btn-lg">Salvar Alterações</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
  <!-- Carrega jQuery e o Mask Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
          integrity="sha512-894YeJE1Yb3UCG+1DfCVQ6F5Q5e5b5Y5vb71s5E6v1j+0ycXnE3HZX4w0H0p+8ZTlSUI+ZjZPdXzR5U2V7p+RA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"
          integrity="sha512-+oM6joggpWZp7+O4H6aAwBsrN1wQfIW3bY5km8K5pD7K5n5EolYc7r4X5xWmY5+vF1yZ1Q2sE3Q0t6vZ6v9jdg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(function(){
      // Máscaras
      $('#cep').mask('00000-000');

      $('#cpf').mask('000.000.000-00');
      $('#phone').mask('(00) 00000-0000');

      // Auto-preenchimento de Estado e Cidade assim que CEP completo
      $('#cep').on('input', function(){
        const cepRaw = $(this).val().replace(/\D/g, '');
        if (cepRaw.length !== 8) return;

        $.getJSON(`https://viacep.com.br/ws/${cepRaw}/json/`)
          .done(function(data){
            if (!data.erro) {
              $('#state').val(data.uf);
              $('#city').val(data.localidade);
            } else {
              alert('CEP não encontrado.');
            }
          })
          .fail(function(){
            alert('Erro ao buscar o CEP.');
          });
      });
    });
  </script>
@endpush

