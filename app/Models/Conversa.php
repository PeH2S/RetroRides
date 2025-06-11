<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversa extends Model
{
    protected $fillable = ['anuncio_id', 'comprador_id', 'anunciante_id'];

    public function anuncio(): BelongsTo {
        return $this->belongsTo(Anuncio::class);
    }

    public function comprador(): BelongsTo {
        return $this->belongsTo(User::class, 'comprador_id');
    }

    public function anunciante(): BelongsTo {
        return $this->belongsTo(User::class, 'anunciante_id');
    }

    public function mensagens(): HasMany {
        return $this->hasMany(Mensagem::class);
    }
}
