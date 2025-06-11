<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo_veiculo',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotos()
    {
        return $this->hasMany(AnuncioFoto::class);
    }

    public function favoritadoPor()
    {
        return $this->belongsToMany(User::class, 'favoritos')
            ->withTimestamps();
    }

    public function getEstaFavoritadoAttribute()
    {
        return auth()->check() && $this->favoritadoPor()
            ->where('user_id', auth()->id())
            ->exists();
    }
}
