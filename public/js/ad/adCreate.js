document.addEventListener("DOMContentLoaded", () => {
    const marcaSelect = document.getElementById("marca");
    const modeloSelect = document.getElementById("modelo");
    const anoModeloSelect = document.getElementById("ano_modelo");
    const anoFabricacaoSelect = document.getElementById("ano_fabricacao");
    const versaoSelect = document.getElementById("versao");

    const pathSegments = window.location.pathname.split('/').filter(segment => segment.trim() !== '');
    const vehicleType = pathSegments[pathSegments.length - 2];
    console.log("Tipo de veículo detectado:", vehicleType);

    const validTypes = ['carro', 'moto', 'caminhao'];
    if (!validTypes.includes(vehicleType)) {
        console.error('Tipo de veículo inválido na URL:', vehicleType);
        return;
    }

    const fillSelect = (selectElement, data, defaultValue = 'Selecione') => {
        selectElement.innerHTML = `<option disabled selected>${defaultValue}</option>`;

        if (!Array.isArray(data)) {
            console.error('Dados recebidos não são um array:', data);
            selectElement.innerHTML = '<option disabled selected>Erro nos dados</option>';
            return;
        }

        data.forEach(item => {
            if (item && item.code && item.name) {
                let displayName = item.name;

                if (selectElement.id === "ano_modelo" || selectElement.id === "ano_fabricacao") {
                    displayName = item.name.split(' ')[0];
                }

                selectElement.innerHTML += `<option value="${item.code}">${displayName}</option>`;
            } else {
                console.warn('Item inválido ignorado:', item);
            }
        });
    };



    fetch(`/api/marcas?tipo=${vehicleType}`)
        .then(res => {
            if (!res.ok) throw new Error(`Erro ${res.status} ao carregar marcas`);
            return res.json();
        })
        .then(data => {
            console.log('Marcas recebidas:', data);
            fillSelect(marcaSelect, data);
        })
        .catch(error => {
            console.error('Erro ao carregar marcas:', error);
            marcaSelect.innerHTML = '<option disabled selected>Erro ao carregar</option>';
        });

    marcaSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        if (!marcaId || marcaId === 'undefined') return;

        modeloSelect.disabled = false;
        fillSelect(modeloSelect, [], 'Carregando...');

        fetch(`/api/modelos/${marcaId}?tipo=${vehicleType}`)
            .then(res => {
                if (!res.ok) throw new Error(`Erro ${res.status} ao carregar modelos`);
                return res.json();
            })
            .then(data => {
                console.log('Modelos recebidos:', data);
                fillSelect(modeloSelect, data);
            })
            .catch(error => {
                console.error('Erro ao carregar modelos:', error);
                fillSelect(modeloSelect, [], 'Erro ao carregar');
            });
    });

    modeloSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        const modeloId = modeloSelect.value;
        if (!marcaId || !modeloId || modeloId === 'undefined') return;

        anoModeloSelect.disabled = false;
        anoFabricacaoSelect.disabled = false;
        fillSelect(anoModeloSelect, [], 'Carregando...');
        fillSelect(anoFabricacaoSelect, [], 'Carregando...');

        fetch(`/api/anos/${marcaId}/${modeloId}?tipo=${vehicleType}`)
            .then(res => {
                if (!res.ok) throw new Error(`Erro ${res.status} ao carregar anos`);
                return res.json();
            })
            .then(data => {
                console.log('Anos recebidos:', data);
                fillSelect(anoModeloSelect, data);
                fillSelect(anoFabricacaoSelect, data);
            })
            .catch(error => {
                console.error('Erro ao carregar anos:', error);
                fillSelect(anoModeloSelect, [], 'Erro ao carregar');
                fillSelect(anoFabricacaoSelect, [], 'Erro ao carregar');
            });
    });

    anoModeloSelect.addEventListener("change", () => {
        const marcaId = marcaSelect.value;
        const modeloId = modeloSelect.value;
        const anoId = anoModeloSelect.value;
        if (!marcaId || !modeloId || !anoId || anoId === 'undefined') return;

        fetch(`/api/detalhes/${marcaId}/${modeloId}/${anoId}?tipo=${vehicleType}`)
            .then(res => {
                if (!res.ok) throw new Error(`Erro ${res.status} ao buscar detalhes do veículo`);
                return res.json();
            })
            .then(data => {
                console.log("Detalhes do veículo:", data);
                const combustivel = data.fuel;
                if (combustivel) {
                    document.getElementById("combustivel").value = combustivel;
                    document.getElementById("combustivel_visivel").value = combustivel;
                }
                console.log(combustivel);
            })
            .catch(error => {
                console.error('Erro ao buscar combustível:', error);
            });
    });

});
document.getElementById("form-anuncio").addEventListener("submit", function (e) {
    const combustivel = document.getElementById("combustivel").value;

    if (!combustivel) {
        e.preventDefault();
        alert("Por favor, selecione o modelo e o ano do veículo para carregar o tipo de combustível.");
    }
});
