$(document).ready(function() {
    // Máscaras iniciais
    $('#phone').mask('(00) 00000-0000');
    $('#rg').mask('00.000.000-0');
    $('#state_registration').mask('000.000.000.000');
    $('#cpfInput').mask('000.000.000-00', {reverse: true});
    $('#cnpjInput').mask('00.000.000/0000-00', {reverse: true});

    // Função para alternar entre PF e PJ
    function toggleUserType() {
        const isPJ = $('#toggleType').is(':checked');
        
        // Atualiza visual dos labels
        $('#pfLabel').toggleClass('active', !isPJ);
        $('#pjLabel').toggleClass('active', isPJ);
        
        // Alterna visibilidade dos campos
        $('#pfFields').toggleClass('hidden', isPJ);
        $('#pjFields').toggleClass('hidden', !isPJ);
    }

    // Configura eventos
    $('#toggleType').change(toggleUserType);

    // Inicializa o formulário
    toggleUserType();
});