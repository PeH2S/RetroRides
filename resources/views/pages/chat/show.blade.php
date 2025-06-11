@extends('static.layoutHome')

@section('main')
    <div class="container" x-data="chatComponent({{ $conversa->id }}, {{ auth()->id() }})">
        <h2>Chat com
            {{ $conversa->comprador_id === auth()->id() ? $conversa->anunciante->name : $conversa->comprador->name }}</h2>

        <div class="card mt-4">
            <div class="card-body" style="height: 400px; overflow-y: auto;" id="chatBox">
                <template x-for="msg in mensagens" :key="msg.id">
                    <div :class="msg.remetente_id === userId ? 'text-end' : 'text-start'" class="mb-2" x-transition>
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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/js/app.js')
    <script>
        function chatComponent(conversaId, userId) {
            return {
                conversaId,
                userId,
                novaMensagem: '',
                mensagens: @json($conversa->mensagens),
                init() {
                    const waitForEcho = setInterval(() => {
                        if (window.Echo?.connector?.pusher?.connection?.state) {
                            clearInterval(waitForEcho);

                            console.log(window.Echo.connector.pusher.connection.state);
                            console.log('Entrou no canal:', 'conversa.' + this.conversaId);

                            Echo.channel('conversa.' + this.conversaId)
                                .listen('.nova.mensagem', (e) => {
                                    console.log('Nova mensagem recebida:', e);
                                    this.mensagens.push(e.mensagem);
                                    this.$nextTick(() => {
                                        const box = document.getElementById('chatBox');
                                        box.scrollTop = box.scrollHeight;
                                    });
                                });
                        }
                    }, 100);

                    setInterval(() => {
                        fetch(`/conversas/${this.conversaId}/mensagens/check`, {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.total > this.mensagens.length) {
                                    location.reload();
                                }
                            });
                    }, 10000); // 10 segundos
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
                            this.mensagens.push(data.mensagem);
                            this.novaMensagem = '';

                            this.$nextTick(() => {
                                const box = document.getElementById('chatBox');
                                box.scrollTop = box.scrollHeight;
                            });
                        });
                }
            }
        }
    </script>
@endsection
