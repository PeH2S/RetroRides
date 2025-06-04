document.getElementById("cep-input").addEventListener("keydown", async function (e) {
    if (e.key === "Enter") {
        e.preventDefault();
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            document.getElementById("cep-resultado").textContent = "CEP inválido. Digite 8 números.";
            return;
        }

        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await response.json();

            if (data.erro) {
                document.getElementById("cep-resultado").textContent = "CEP não encontrado.";
                return;
            }

            document.getElementById("cep-resultado").textContent = `${data.localidade} - ${data.uf}`;

            // Salvar na sessão via Laravel
            const salvar = await fetch("/definir-localizacao", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    latitude: null,
                    longitude: null,
                    cidade: data.localidade,
                    estado: data.uf
                })
            });

            const res = await salvar.json();

            if (res.sucesso) {
                document.getElementById("user-location-text").innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${data.localidade} - ${data.uf}`;
                document.getElementById("location-modal").style.display = "none";
            }

        } catch (error) {
            document.getElementById("cep-resultado").textContent = "Erro ao buscar o CEP.";
        }
    }
});
