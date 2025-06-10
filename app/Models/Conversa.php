<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Anuncio;
use App\Models\User;
use App\Models\Mensagem;


class Conversa extends Model
{
    public function mensagens()
    {
        return $this->hasMany(Mensagem::class);
    }
    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }
    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }
    public function anunciante()
    {
        return $this->belongsTo(User::class, 'anunciante_id');
    }
}
