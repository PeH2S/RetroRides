// public/js/ad/adCreate.js
document.addEventListener("DOMContentLoaded", () => {
    const marcaSelect = document.getElementById("marca");
    const modeloSelect = document.getElementById("modelo");
    const anoModeloSelect = document.getElementById("ano_modelo");
    const anoFabricacaoSelect = document.getElementById("ano_fabricacao");
    const versaoSelect = document.getElementById("versao");

    // Carrega marcas
    fetch('/api/marcas')
        .then(res => {
            if (!res.ok) throw new Error('Erro ao carregar marcas');
            return res.json();
        })
        .then(data => {
            marcaSelect.innerHTML = '<option disabled selected>Selecione</option>';
            data.forEach(marca => {
                marcaSelect.innerHTML += `<option value="${marca.codigo}">${marca.nome}</option>`;
            });
        })
        .catch(error => {
            console.error('Erro:', error);
            marcaSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
        });

    // Quando selecionar marca -> carrega modelos
    marcaSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        modeloSelect.disabled = false;
        modeloSelect.innerHTML = '<option disabled selected>Carregando...</option>';

        fetch(`/api/modelos/${marcaId}`)
            .then(res => {
                if (!res.ok) throw new Error('Erro ao carregar modelos');
                return res.json();
            })
            .then(data => {
                modeloSelect.innerHTML = '<option disabled selected>Selecione</option>';
                data.forEach(modelo => {
                    modeloSelect.innerHTML += `<option value="${modelo.codigo}">${modelo.nome}</option>`;
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                modeloSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
            });
    });

    // Quando selecionar modelo -> carrega anos
    modeloSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        const modeloId = modeloSelect.value;
        anoModeloSelect.disabled = false;
        anoFabricacaoSelect.disabled = false;
        anoModeloSelect.innerHTML = '<option disabled selected>Carregando...</option>';
        anoFabricacaoSelect.innerHTML = '<option disabled selected>Carregando...</option>';

        fetch(`/api/anos/${marcaId}/${modeloId}`)
            .then(res => {
                if (!res.ok) throw new Error('Erro ao carregar anos');
                return res.json();
            })
            .then(data => {
                anoModeloSelect.innerHTML = '<option disabled selected>Selecione</option>';
                anoFabricacaoSelect.innerHTML = '<option disabled selected>Selecione</option>';

                // Supondo que a API retorne anos de modelo e fabricação juntos
                data.forEach(ano => {
                    anoModeloSelect.innerHTML += `<option value="${ano.codigo}">${ano.nome}</option>`;
                    anoFabricacaoSelect.innerHTML += `<option value="${ano.codigo}">${ano.nome}</option>`;
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                anoModeloSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
                anoFabricacaoSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
            });
    });

    // Quando selecionar ano -> carrega versões
    anoModeloSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        const modeloId = modeloSelect.value;
        const anoId = anoModeloSelect.value;
        versaoSelect.disabled = false;
        versaoSelect.innerHTML = '<option disabled selected>Carregando...</option>';

        fetch(`/api/versoes/${marcaId}/${modeloId}/${anoId}`)
            .then(res => {
                if (!res.ok) throw new Error('Erro ao carregar versões');
                return res.json();
            })
            .then(data => {
                versaoSelect.innerHTML = '<option disabled selected>Selecione</option>';
                data.forEach(versao => {
                    versaoSelect.innerHTML += `<option value="${versao.codigo}">${versao.nome}</option>`;
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                versaoSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
            });
    });
});
