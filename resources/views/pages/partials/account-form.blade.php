
<form action="{{ route('dashboard.account.update') }}" method="POST" id="form-minha-conta">
  @csrf

  <div class="row mb-4">
    {{-- Meus Dados --}}
    <div class="col-lg-6 mb-4">
      <div class="bg-white p-4 rounded shadow-sm">
        <h5 class="mb-3">Meus Dados</h5>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail*</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            value="{{ old('email', $user->email) }}"
            required
          >
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Nome completo*</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            value="{{ old('name', $user->name) }}"
            required
          >
        </div>

        <div class="mb-3">
          <label for="gender" class="form-label">Gênero*</label>
          <select
            id="gender"
            name="gender"
            class="form-select"
            required
          >
            <option value="" disabled>Selecione</option>
            <option value="masculino" @selected(old('gender', $user->gender)=='masculino')>Masculino</option>
            <option value="feminino"  @selected(old('gender', $user->gender)=='feminino')>Feminino</option>
            <option value="outro"     @selected(old('gender', $user->gender)=='outro')>Outro</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="birthdate" class="form-label">Data de nascimento*</label>
          <input
            type="text"
            id="birthdate"
            name="birthdate"
            class="form-control"
            value="{{ old('birthdate', optional($user->birthdate)->format('d/m/Y')) }}"
            required
          >
        </div>

        <div class="mb-3">
          <label for="cpf" class="form-label">CPF*</label>
          <input
            type="text"
            id="cpf"
            name="cpf"
            class="form-control"
            value="{{ old('cpf', $user->cpf) }}"
            required
          >
        </div>

        <p class="small text-muted">Cadastro exclusivo para maiores de 18 anos.</p>
      </div>
    </div>

    {{-- Endereço & Contato --}}
    <div class="col-lg-6 mb-4">
      <div class="bg-white p-4 rounded shadow-sm">
        <h5 class="mb-3">Endereço e Contato</h5>

        <div class="mb-3">
          <label for="cep" class="form-label">CEP*</label>
          <input
            type="text"
            id="cep"
            name="cep"
            class="form-control"
            value="{{ old('cep', $user->cep) }}"
            required
          >
        </div>

        <div class="row g-2 mb-3">
          <div class="col-md-4">
            <label for="state" class="form-label">Estado*</label>
            <input
              type="text"
              id="state"
              name="state"
              class="form-control"
              value="{{ old('state', $user->state) }}"
              required
            >
          </div>
          <div class="col-md-8">
            <label for="city" class="form-label">Cidade*</label>
            <input
              type="text"
              id="city"
              name="city"
              class="form-control"
              value="{{ old('city', $user->city) }}"
              required
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Telefone</label>
          <input
            type="text"
            id="phone"
            name="phone"
            class="form-control"
            value="{{ old('phone', $user->phone) }}"
          >
        </div>

        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            id="show_phone"
            name="show_phone"
            value="1"
            @checked(old('show_phone', $user->show_phone))
          >
          <label class="form-check-label" for="show_phone">
            Exibir telefone
          </label>
        </div>
      </div>
    </div>
  </div>

  {{-- Botão de Salvar --}}
  <div class="text-end">
    <button type="submit" class="btn btn-custom w-100 py-2">
      Salvar alterações
    </button>
  </div>
</form>

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
      $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, data => {
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
