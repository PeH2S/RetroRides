<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnuncioFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'anuncio_id',
        'caminho',
        'principal',
        'ordem'
    ];

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }
}
