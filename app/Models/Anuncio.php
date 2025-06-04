<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anuncio extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'marca',
        'modelo',
        'ano_modelo',
        'ano_fabricacao',
        'combustivel',
        'cor',
        'preco',
        'localizacao',
        'quilometragem',
        'portas',
        'placa',
        'situacao',
        'detalhes',
        'opcionais',
        'observacoes',
        'status',
    ];

    /**
     * Relação: cada Anuncio pertence a um User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relação: um Anuncio pode ter várias fotos.
     */
    public function fotos()
    {
        return $this->hasMany(AnuncioFoto::class);
    }
}
