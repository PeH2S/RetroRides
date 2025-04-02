@extends('layoutCreate')
@section('create')
<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

    <div class="col-12 col-md-8 col-lg-6 p-4 border rounded shadow-sm bg-white">
        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

        <!-- Interruptor para escolher entre Pessoa Física e Jurídica -->
        <div class="toggle-container mb-4">
            <span id="pfLabel" class="toggle-label active">Pessoa Física</span>
            <div class="form-check form-switch mx-2">
                <input class="form-check-input" type="checkbox" id="toggleType">
            </div>
            <span id="pjLabel" class="toggle-label">Pessoa Jurídica</span>
        </div>

        <form>
            <!-- Campos específicos para Pessoa Física -->
            <div id="pfFields">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" id="phone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="birth_date" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="birth_date">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rg" class="form-label">RG:</label>
                        <input type="text" class="form-control" id="rg">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpfInput" required>
                    </div>
                </div>
            </div>

            <!-- Campos específicos para Pessoa Jurídica -->
            <div id="pjFields" class="hidden">
                <div class="row">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Razão Social:</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fantasy_name" class="form-label">Nome Fantasia:</label>
                        <input type="text" class="form-control" id="company_name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="company_email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CNPJ:</label>
                        <input type="text" class="form-control" id="cnpjInput" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="state_registration" class="form-label">Inscrição Estadual:</label>
                        <input type="text" class="form-control" id="state_registration">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Endereço Completo:</label>
                <input type="text" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirme a Senha:</label>
                    <input type="password" class="form-control" id="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Cadastrar</button>
        </form>
    </div>
</div>

@endsection