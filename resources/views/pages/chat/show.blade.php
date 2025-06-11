@extends('static.layoutHome')

@section('main')
<div class="container" x-data="chatComponent({{ $conversa->id }}, {{ auth()->id() }})">
    <h2>Chat com {{ $conversa->comprador_id === auth()->id() ? $conversa->anunciante->name : $conversa->comprador->name }}</h2>

    <div class="card mt-4">
        <div class="card-body" style="height: 400px; overflow-y: auto;" id="chatBox">
            <template x-for="msg in mensagens" :key="msg.id">
                <div :class="msg.remetente_id === userId ? 'text-end' : 'text-start'" class="mb-2">
                    <span class="badge bg-secondary" x-text="msg.conteudo"></span>
                </div>
            </template>
        </div>
    </div>

    <form @submit.prevent="enviarMensagem" class="mt-3">
        <div class="input-group">
            <input type="text" class="form-control" x-model="novaMensagem" placeholder="Digite sua mensagem...">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
</div>

@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function chatComponent(conversaId, userId) {
        return {
            conversaId,
            userId,
            novaMensagem: '',
            mensagens: @json($conversa->mensagens),

            init() {
                Echo.channel('conversa.' + this.conversaId)
                    .listen('.NovaMensagem', (e) => {
                        this.mensagens.push(e.mensagem);
                        this.$nextTick(() => {
                            const box = document.getElementById('chatBox');
                            box.scrollTop = box.scrollHeight;
                        });
                    });
            },

            enviarMensagem() {
                if (this.novaMensagem.trim() === '') return;

                fetch('/mensagens', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        conversa_id: this.conversaId,
                        conteudo: this.novaMensagem
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    this.novaMensagem = '';
                });
            }
        }
    }
</script>
@endsection
