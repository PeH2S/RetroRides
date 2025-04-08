// resources/js/listings.js
$(document).ready(function() {
    $('#brand').change(function() {
        let brandId = $(this).val();

        if (brandId) {
            $.get(`/api/models/${brandId}`, function(data) {
                let modelSelect = $('#model');
                modelSelect.empty().append('<option value="">Todos os Modelos</option>');
                modelSelect.prop('disabled', false);

                $.each(data, function(key, model) {
                    modelSelect.append(`<option value="${model.id}">${model.name}</option>`);
                });
            });
        } else {
            $('#model').empty().append('<option value="">Selecione uma marca primeiro</option>').prop('disabled', true);
            $('#year').empty().append('<option value="">Selecione um modelo primeiro</option>').prop('disabled', true);
        }
    });

    $('#model').change(function() {
        let modelId = $(this).val();

        if (modelId) {
            $.get(`/api/years/${modelId}`, function(data) {
                let yearSelect = $('#year');
                yearSelect.empty().append('<option value="">Todos os Anos</option>');
                yearSelect.prop('disabled', false);

                $.each(data, function(key, year) {
                    yearSelect.append(`<option value="${year.id}">${year.year}</option>`);
                });
            });
        } else {
            $('#year').empty().append('<option value="">Selecione um modelo primeiro</option>').prop('disabled', true);
        }
    });
});
