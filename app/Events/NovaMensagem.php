<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaMensagem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensagem;

    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }


    public function broadcastOn()
    {
        return new Channel('conversa.' . $this->mensagem->conversa_id);
    }

    public function broadcastWith()
    {
        return [
            'mensagem' => $this->mensagem
        ];
    }

    public function broadcastAs()
    {
        return 'nova.mensagem'; 
    }
}
