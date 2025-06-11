<?php

use App\Models\Conversa;

Broadcast::channel('conversa.{id}', function ($user, $id) {
    $conversa = Conversa::find($id);
    if (!$conversa) return false;

    return $user->id === $conversa->comprador_id || $user->id === $conversa->anunciante_id;
});
