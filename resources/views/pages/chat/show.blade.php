@extends('static.layoutHome')

@section('main')
    <style>
        .chat-container {
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 150px);
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            background-color: #004E64;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-back {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin-right: 10px;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: #b3d7e3;
        }

        .chat-header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e6f2f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #004E64;
            font-weight: bold;
        }

        .chat-header-info {
            flex: 1;
        }

        .chat-header-info h5 {
            margin: 0;
            font-size: 1.1rem;
        }

        .chat-header-info small {
            opacity: 0.8;
            font-size: 0.8rem;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
        }

        .message-sent {
            align-self: flex-end;
            background-color: #004E64;
            color: white;
            border-bottom-right-radius: 5px;
        }

        .message-received {
            align-self: flex-start;
            background-color: white;
            color: #333;
            border-bottom-left-radius: 5px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .message-time {
            font-size: 0.7rem;
            opacity: 0.7;
            text-align: right;
            margin-top: 5px;
        }

        .chat-input {
            background-color: white;
            padding: 15px;
            display: flex;
            gap: 10px;
            border-top: 1px solid #eee;
        }

        .chat-input input {
            flex: 1;
            border-radius: 20px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            outline: none;
        }

        .chat-input input:focus {
            border-color: #004E64;
        }

        .chat-input button {
            background-color: #004E64;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .chat-input button:hover {
            background-color: #00394b;
        }

        .typing-indicator {
            font-size: 0.8rem;
            color: #666;
            padding-left: 15px;
            font-style: italic;
            height: 20px;
        }

        .message-status {
            position: absolute;
            right: 5px;
            bottom: 5px;
            font-size: 0.7rem;
        }

        .message-status .read {
            color: #4fc3f7;
        }
    </style>

    <div class="chat-container" x-data="chatComponent({{ $conversa->id }}, {{ auth()->id() }})">
        <!-- Cabeçalho do chat -->
        <div class="chat-header">
            @if (in_array($conversa->anuncio->status, ['finalizado', 'cancelado']))
                <div style="padding: 15px; background: #fff3cd; color: #852204; text-align: center;">
                    Esta conversa foi encerrada. O anúncio está {{ $conversa->anuncio->status }}.
                </div>
            @else
                <div class="chat-input">
                    <!-- input e botão -->
                </div>
            @endif
            <div class="chat-header-avatar">
                @php
                    $otherUser =
                        $conversa->comprador_id === auth()->id() ? $conversa->anunciante : $conversa->comprador;
                    echo strtoupper(substr($otherUser->name, 0, 1));
                @endphp
            </div>
            <div class="chat-header-info">
                <h5>{{ $conversa->comprador_id === auth()->id() ? $conversa->anunciante->name : $conversa->comprador->name }}
                </h5>
                <small x-text="typing ? 'digitando...' : 'online'"></small>
            </div>

            <!-- Botão voltar para listagem -->
            <button onclick="window.location.href='{{ route('chat.index') }}'"
                style="margin-left: auto; background: #eee; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;"
                title="Voltar para listagem">
                ← Voltar
            </button>

            @if (auth()->id() === $conversa->comprador_id)
                <!-- Botão cancelar (para comprador) -->
                <button @click="cancelarConversa()"
                    style="margin-left: 10px; background: #f44336; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;"
                    title="Cancelar conversa">
                    Cancelar
                </button>
            @elseif(auth()->id() === $conversa->anunciante_id)
                <!-- Botão finalizar (para anunciante) -->
                <button @click="finalizarConversa()"
                    style="margin-left: 10px; background: #4caf50; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;"
                    title="Finalizar conversa">
                    Finalizar
                </button>
            @endif
        </div>


        <!-- Indicador de digitação -->
        <div class="typing-indicator" x-show="typing" x-transition>
            {{ $conversa->comprador_id === auth()->id() ? $conversa->anunciante->name : $conversa->comprador->name }} está
            digitando...
        </div>

        <!-- Área de mensagens -->
        <div class="chat-messages" id="chatBox">
            <template x-for="msg in mensagens" :key="msg.id">
                <div :class="msg.remetente_id === userId ? 'message message-sent' : 'message message-received'"
                    x-transition>
                    <div x-text="msg.conteudo"></div>
                    <div class="message-time" x-text="formatTime(msg.created_at)"></div>
                    <div class="message-status" x-show="msg.remetente_id === userId">
                        <template x-if="msg.lido">
                            <span class="read">✓✓</span>
                        </template>
                        <template x-if="!msg.lido">
                            <span>✓</span>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Input de mensagem -->
        <div class="chat-input">
            <input type="text" x-model="novaMensagem" placeholder="Digite sua mensagem..." @keydown="startTyping"
                @keyup="stopTyping" @keyup.enter="enviarMensagem">
            <button @click="enviarMensagem" title="Enviar">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
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
                typing: false,
                typingTimer: null,
                anuncioStatus: '{{ $conversa->anuncio->status }}',

                init() {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });

                    // Echo config
                    const waitForEcho = setInterval(() => {
                        if (window.Echo?.connector?.pusher?.connection?.state) {
                            clearInterval(waitForEcho);
                            Echo.channel('conversa.' + this.conversaId)
                                .listen('.nova.mensagem', (e) => {
                                    this.mensagens.push(e.mensagem);
                                    this.markAsRead();
                                    this.scrollToBottom();
                                })
                                .listenForWhisper('typing', (e) => {
                                    if (e.user_id !== this.userId) {
                                        this.typing = true;
                                        clearTimeout(this.typingTimer);
                                        this.typingTimer = setTimeout(() => {
                                            this.typing = false;
                                        }, 2000);
                                    }
                                });
                        }
                    }, 100);

                    setInterval(() => {
                        this.checkNewMessages();
                    }, 10000);

                    this.markAsRead();
                },
                atualizarStatus(novoStatus) {
                    fetch(`/conversas/${this.conversaId}/atualizar-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                status: novoStatus
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.anuncioStatus = novoStatus;
                                alert(`Conversa foi ${novoStatus}.`);
                            } else {
                                alert('Erro ao atualizar status. Tente novamente.');
                            }
                        })
                        .catch(() => {
                            alert('Erro ao atualizar status. Tente novamente.');
                        });
                },

                cancelarConversa() {
                    if (confirm('Tem certeza que deseja cancelar a conversa?')) {
                        this.atualizarStatus('cancelado');
                    }
                },

                finalizarConversa() {
                    if (confirm('Tem certeza que deseja finalizar a conversa?')) {
                        this.atualizarStatus('finalizado');
                    }
                },

                formatTime(timestamp) {
                    const date = new Date(timestamp);
                    return date.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                scrollToBottom() {
                    const box = document.getElementById('chatBox');
                    box.scrollTop = box.scrollHeight;
                },

                startTyping() {
                    Echo.private('conversa.' + this.conversaId)
                        .whisper('typing', {
                            user_id: this.userId
                        });
                },

                stopTyping() {
                    clearTimeout(this.typingTimer);
                    this.typingTimer = setTimeout(() => {
                        this.typing = false;
                    }, 2000);
                },

                checkNewMessages() {
                    fetch(`/conversas/${this.conversaId}/mensagens/check`, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.total > this.mensagens.length) {
                                fetch(`/conversas/${this.conversaId}/mensagens`)
                                    .then(res => res.json())
                                    .then(data => {
                                        this.mensagens = data;
                                        this.scrollToBottom();
                                        this.markAsRead();
                                    });
                            }
                        });
                },

                markAsRead() {
                    if (this.mensagens.length > 0 &&
                        this.mensagens[this.mensagens.length - 1].remetente_id !== this.userId) {
                        fetch(`/mensagens/mark-as-read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                conversa_id: this.conversaId
                            }),
                        });
                    }
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
                            this.scrollToBottom();
                        });
                }
            }
        }
    </script>
@endsection
