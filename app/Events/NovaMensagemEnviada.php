<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Mensagem;

class NovaMensagemEnviada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensagem;

    /**
     * Create a new event instance.
     */
    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn() {
        return new PrivateChannel('conversa.' . $this->mensagem->conversa_id);
    }
     public function broadcastWith() {
        return [
            'conteudo' => $this->mensagem->conteudo,
            'remetente_id' => $this->mensagem->remetente_id,
            'conversa_id' => $this->mensagem->conversa_id,
            'created_at' => $this->mensagem->created_at->toDateTimeString(),
        ];
    }

}
