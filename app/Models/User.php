<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Anuncio;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function phoneRecord()
    {
        return $this->hasOne(Phone::class);
    }
    public function avaliacoesRecebidas()
    {
        return $this->hasMany(Avaliacao::class, 'anunciante_id');
    }

    public function avaliacoesFeitas()
    {
        return $this->hasMany(Avaliacao::class, 'avaliador_id');
    }

    public function getMediaAvaliacoesAttribute()
    {
        return $this->avaliacoesRecebidas()->avg('nota');
    }
    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function anunciosFavoritados()
    {
        return $this->belongsToMany(Anuncio::class, 'favoritos')
            ->withTimestamps();
    }
}
