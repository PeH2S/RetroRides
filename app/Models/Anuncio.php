<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'ano_modelo',
        'ano_fabricacao',
        'cor',
        'preco',
        'quilometragem',
        'combustivel',
        'portas',
        'placa',
        'final_placa',
        'descricao',
        'status',
        // 'user_id' // autenticação de usuário
    ];

    public function fotos()
    {
        return $this->hasMany(AnuncioFoto::class);
    }
}
