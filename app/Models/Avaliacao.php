<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    
    use HasFactory;

    protected $fillable = [
        'avaliador_id',
        'anunciante_id',
        'anuncio_id',
        'nota',
        'comentario'
    ];

    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }

    public function anunciante()
    {
        return $this->belongsTo(User::class, 'anunciante_id');
    }

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }
}
