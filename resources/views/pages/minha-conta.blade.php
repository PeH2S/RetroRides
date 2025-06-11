@extends('static.layoutHome')

@section('main')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 bg-light border-end vh-100 p-0">
      @include('partials.sidebar')
    </div>
    <div class="col-md-9 p-4">
      <h1>Minha Conta</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('dashboard.account.update') }}" method="POST" id="form-minha-conta">
        @csrf

        {{-- E-mail --}}
        <div class="mb-3">
          <label for="email" class="form-label">E-mail*</label>
          <input type="email" id="email" name="email"
                 value="{{ old('email', $user->email) }}"
                 class="form-control" required>
        </div>

        {{-- Nome --}}
        <div class="mb-3">
          <label for="name" class="form-label">Nome completo*</label>
          <input type="text" id="name" name="name"
                 value="{{ old('name', $user->name) }}"
                 class="form-control" required>
        </div>

        {{-- Gênero --}}
        <div class="mb-3">
          <label for="gender" class="form-label">Gênero</label>
          <select id="gender" name="gender" class="form-control">
            <option value="">Selecione</option>
            <option value="masculino"  @selected(old('gender', $user->gender)=='masculino')>Masculino</option>
            <option value="feminino"   @selected(old('gender', $user->gender)=='feminino')>Feminino</option>
            <option value="outro"      @selected(old('gender', $user->gender)=='outro')>Outro</option>
          </select>
        </div>

        {{-- Data de Nascimento --}}
        <div class="mb-3">
          <label for="birthdate" class="form-label">Data de nascimento</label>
          <input type="text" id="birthdate" name="birthdate"
                 value="{{ old('birthdate', optional($user->birthdate)->format('d/m/Y')) }}"
                 class="form-control">
        </div>

        {{-- CPF --}}
        <div class="mb-3">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" id="cpf" name="cpf"
                 value="{{ old('cpf', $user->cpf) }}"
                 class="form-control">
        </div>

        {{-- CEP --}}
        <div class="mb-3">
          <label for="cep" class="form-label">CEP</label>
          <input type="text" id="cep" name="cep"
                 value="{{ old('cep', $user->cep) }}"
                 class="form-control">
        </div>

        {{-- Estado e Cidade --}}
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="state" class="form-label">Estado</label>
            <input type="text" id="state" name="state"
                   value="{{ old('state', $user->state) }}"
                   class="form-control">
          </div>
          <div class="col-md-8 mb-3">
            <label for="city" class="form-label">Cidade</label>
            <input type="text" id="city" name="city"
                   value="{{ old('city', $user->city) }}"
                   class="form-control">
          </div>
        </div>

        {{-- Telefone --}}
        <div class="mb-3">
          <label for="phone" class="form-label">Telefone</label>
          <input type="text" id="phone" name="phone"
                 value="{{ old('phone', $user->phone) }}"
                 class="form-control">
        </div>

        {{-- Exibir Telefone --}}
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="show_phone" name="show_phone"
                 @checked(old('show_phone', $user->show_phone))>
          <label class="form-check-label" for="show_phone">
            Exibir telefone
          </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Salvar alterações</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(function(){
  $('#cpf').mask('000.000.000-00');
  $('#cep').mask('00000-000');
  $('#phone').mask('(00) 00000-0000');
  $('#birthdate').mask('00/00/0000');

  $('#cep').on('blur', function(){
    let cep = $(this).val().replace(/\D/g, '');
    if (cep.length === 8){
      $('#state, #city').val('Carregando...');
      $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data){
        if (!data.erro){
          $('#state').val(data.uf);
          $('#city').val(data.localidade);
        } else {
          alert('CEP não encontrado');
          $('#state, #city').val('');
        }
      });
    }
  });
});
</script>
@endpush
