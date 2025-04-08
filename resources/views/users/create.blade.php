@extends('layoutCreate')
@section('create')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
</div>
@endif

<div class="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-12 col-md-8 col-lg-6 p-4 border rounded shadow-sm bg-white">
        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

        <!-- Alternador PF/PJ melhorado -->
        <div class="d-flex justify-content-center align-items-center mb-4" role="group" aria-labelledby="userTypeToggle">
            <span id="pfLabel" class="toggle-label fw-bold text-primary">Pessoa Física</span>

            <div class="form-check form-switch mx-2">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="toggleType"
                    name="is_juridica"
                    style="width: 3em; height: 1.5em;"
                    aria-labelledby="toggleTypeLabel">
                <label class="form-check-label visually-hidden" id="toggleTypeLabel" for="toggleType">Alternar entre pessoa física e jurídica</label>
            </div>

            <span id="pjLabel" class="toggle-label">Pessoa Jurídica</span>
        </div>

        <form id="userForm" method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- Campos Pessoa Física -->
            <div id="pfFields">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="name" required placeholder="Digite seu nome completo">
                        <div class="invalid-feedback">Por favor, informe seu nome completo.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" name="email" required placeholder="exemplo@email.com">
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Telefone *</label>
                        <input type="text" class="form-control phone-mask" name="phone" required placeholder="(00) 00000-0000">
                        <div class="invalid-feedback">Informe um telefone válido.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="birth_date" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" max="2025-04-08" placeholder="dd/mm/aaaa">
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" class="form-control rg-mask" name="rg" placeholder="00.000.000-0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cpf" class="form-label">CPF *</label>
                        <input type="text" class="form-control cpf-mask" name="cpf_cnpj" required placeholder="000.000.000-00">
                        <div class="invalid-feedback">CPF inválido.</div>
                    </div>
                </div>
            </div>

            <!-- Campos Pessoa Jurídica (inicialmente ocultos) -->
            <div id="pjFields" style="display: none;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="company_name" class="form-label">Razão Social *</label>
                        <input type="text" class="form-control" name="company_name" placeholder="Nome legal da empresa">
                        <div class="invalid-feedback">Informe a razão social.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fantasy_name" class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" name="fantasy_name" placeholder="Nome comercial">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="company_email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" name="company_email" placeholder="empresa@email.com">
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="company_phone" class="form-label">Telefone *</label>
                        <input type="text" class="form-control phone-mask" name="company_phone" placeholder="(00) 0000-0000">
                        <div class="invalid-feedback">Informe um telefone válido.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cnpj" class="form-label">CNPJ *</label>
                        <input type="text" class="form-control cnpj-mask" name="cpf_cnpj" placeholder="00.000.000/0000-00">
                        <div class="invalid-feedback">CNPJ inválido.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="state_registration" class="form-label">Inscrição Estadual</label>
                        <input type="text" class="form-control ie-mask" name="state_registration" placeholder="000.000.000.000">
                    </div>
                </div>
            </div>

            <!-- Campos comuns -->
            <div class="mb-3">
                <label for="address" class="form-label">Endereço Completo *</label>
                <input type="text" class="form-control" name="address" required placeholder="Rua, número, complemento, bairro">
                <div class="invalid-feedback">Informe o endereço completo.</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Senha *</label>
                    <input type="password" class="form-control" name="password" required minlength="8" placeholder="Mínimo 8 caracteres">
                    <div class="invalid-feedback">A senha deve ter no mínimo 8 caracteres.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirme a Senha *</label>
                    <input type="password" class="form-control" name="password_confirmation" required placeholder="Digite novamente">
                    <div class="invalid-feedback">As senhas não coincidem.</div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary py-2">
                    <i class="fas fa-user-plus me-2"></i> Cadastrar
                </button>
                <a href="{{ route('login') }}" class="btn btn-link text-center">
                    Já tem conta? Faça login
                </a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        // Máscaras para os campos
        $('.cpf-mask').mask('000.000.000-00');
        $('.cnpj-mask').mask('00.000.000/0000-00');
        $('.phone-mask').mask('(00) 00000-0000');
        $('.rg-mask').mask('00.000.000-0');
        $('.ie-mask').mask('000.000.000.000'); // Máscara da inscrição estadual

        // Alternância entre PF/PJ
        $('#toggleType').change(function() {
            if ($(this).is(':checked')) {
                $('#pfFields').hide();
                $('#pjFields').show();
                $('#pfLabel').removeClass('fw-bold text-primary');
                $('#pjLabel').addClass('fw-bold text-primary');
                $('.cpf-mask').removeAttr('required');
                $('.cnpj-mask').attr('required', 'required');
            } else {
                $('#pfFields').show();
                $('#pjFields').hide();
                $('#pjLabel').removeClass('fw-bold text-primary');
                $('#pfLabel').addClass('fw-bold text-primary');
                $('.cnpj-mask').removeAttr('required');
                $('.cpf-mask').attr('required', 'required');
            }
        });

        // Validação do formulário
        $('#userForm').submit(function(e) {
            e.preventDefault();

            if (this.checkValidity() === false) {
                e.stopPropagation();
            } else {
                // Envio do formulário via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.href = createUrl;
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message || 'Erro ao cadastrar');
                    }
                });
            }

            this.classList.add('was-validated');
            return false;
        });
    });
</script>
@endsection
@endsection