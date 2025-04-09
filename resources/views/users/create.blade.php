@extends('layoutCreate')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
</div>
@endif

<div class="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-12 col-md-8 col-lg-6 p-4 border rounded shadow-sm bg-white">
        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

        <!-- Alternador PF/PJ -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <span id="pfLabel" class="toggle-label fw-bold text-primary">Pessoa Física</span>
            <div class="form-check form-switch mx-2">
                <input class="form-check-input" type="checkbox" id="toggleType" style="width: 3em; height: 1.5em;">
            </div>
            <span id="pjLabel" class="toggle-label">Pessoa Jurídica</span>
        </div>

        <form id="userForm" method="POST" action="{{ route('users.store') }}">
            @csrf

            <input type="hidden" name="is_juridica" id="is_juridica" value="0">

            <!-- Pessoa Física -->
            <div id="pfFields">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">E-mail *</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone *</label>
                        <input type="text" class="form-control phone-mask" name="phone">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="birth_date" max="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">RG</label>
                    <input type="text" class="form-control rg-mask" name="rg">
                </div>
            </div>

            <!-- Pessoa Jurídica -->
            <div id="pjFields" style="display: none;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Razão Social *</label>
                        <input type="text" class="form-control" name="company_name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" name="fantasy_name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">E-mail da Empresa *</label>
                        <input type="email" class="form-control" name="company_email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone da Empresa *</label>
                        <input type="text" class="form-control phone-mask" name="company_phone">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Inscrição Estadual</label>
                    <input type="text" class="form-control ie-mask" name="state_registration">
                </div>
            </div>

            <!-- CPF/CNPJ -->
            <div class="mb-3">
                <label class="form-label" id="cpfCnpjLabel">CPF *</label>
                <input type="text" class="form-control" name="cpf_cnpj" id="cpfCnpjInput" required>
                <div class="invalid-feedback">Documento inválido.</div>
            </div>

            <!-- Endereço -->
            <div class="mb-3">
                <label class="form-label">Endereço *</label>
                <input type="text" class="form-control" name="address" required>
            </div>

            <!-- Senha -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Senha *</label>
                    <input type="password" class="form-control" name="password" required minlength="8">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirmar Senha *</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2">
                    <i class="fas fa-user-plus me-2"></i> Cadastrar
                </button>
                <a href="{{ route('login.form') }}" class="btn btn-link text-center">Já tem conta? Faça login</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('.phone-mask').mask('(00) 00000-0000');
        $('.rg-mask').mask('00.000.000-0');
        $('.ie-mask').mask('000.000.000.000');

        function applyCpfMask() {
            $('#cpfCnpjInput').mask('000.000.000-00');
            $('#cpfCnpjLabel').text('CPF *');
            $('#cpfCnpjInput').attr('placeholder', '000.000.000-00');
        }

        function applyCnpjMask() {
            $('#cpfCnpjInput').mask('00.000.000/0000-00');
            $('#cpfCnpjLabel').text('CNPJ *');
            $('#cpfCnpjInput').attr('placeholder', '00.000.000/0000-00');
        }

        function toggleFormFields(isJuridica) {
            $('#is_juridica').val(isJuridica ? 1 : 0);

            if (isJuridica) {
                $('#pfFields').hide();
                $('#pjFields').show();
                $('#pjLabel').addClass('fw-bold text-primary');
                $('#pfLabel').removeClass('fw-bold text-primary');
                applyCnpjMask();
            } else {
                $('#pjFields').hide();
                $('#pfFields').show();
                $('#pfLabel').addClass('fw-bold text-primary');
                $('#pjLabel').removeClass('fw-bold text-primary');
                applyCpfMask();
            }
        }

        $('#toggleType').change(function () {
            toggleFormFields($(this).is(':checked'));
        });

        toggleFormFields($('#toggleType').is(':checked'));
    });
</script>
@endsection
