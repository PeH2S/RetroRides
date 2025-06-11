document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('location-modal');
  const abrir = document.getElementById('btn-abrir-modal');
  const fechar = document.getElementById('btn-fechar-modal');
  const form = document.getElementById('form-cep');
  const textoLocal = document.getElementById('user-location-text');

  abrir.addEventListener('click', () => modal.style.display = 'block');
  fechar.addEventListener('click', () => modal.style.display = 'none');

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const cep = e.target.cep.value.replace(/\D/g, '');
    const resCep = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await resCep.json();
    if (data.erro) {
      alert('CEP não encontrado');
      return;
    }
    // envia para o nosso controller
    const res = await fetch('/definir-localizacao-cep', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        cidade: data.localidade,
        estado: data.uf
      })
    });
    const json = await res.json();
    if (json.sucesso) {
      textoLocal.innerHTML = `<i class="bi bi-geo-alt-fill"></i> ${data.localidade} - ${data.uf}`;
      modal.style.display = 'none';
    }
  });
});
