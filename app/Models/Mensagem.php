<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{

    protected $table = 'mensagens';
    protected $fillable = ['conversa_id', 'remetente_id', 'conteudo'];

    public function conversa()
    {
        return $this->belongsTo(Conversa::class);
    }

    public function remetente()
    {
        return $this->belongsTo(User::class, 'remetente_id');
    }
}
