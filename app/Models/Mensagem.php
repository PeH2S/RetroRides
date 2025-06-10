<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversa;
use App\Models\User;

class Mensagem extends Model
{
    public function conversa()
    {
        return $this->belongsTo(Conversa::class);
    }
    public function remetente()
    {
        return $this->belongsTo(User::class, 'remetente_id');
    }
}
