<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'birthdate',
        'gender',
        'cep',
        'state',
        'city',
        'phone',
        'show_phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate'         => 'date',
        'show_phone'        => 'boolean',
        'password'          => 'hashed',
    ];

    /**
     * Get the user's announcements.
     */
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }

    /**
     * Get the evaluations received by the user.
     */
    public function avaliacoesRecebidas()
    {
        return $this->hasMany(Avaliacao::class, 'anunciante_id');
    }

    /**
     * Get the evaluations made by the user.
     */
    public function avaliacoesFeitas()
    {
        return $this->hasMany(Avaliacao::class, 'avaliador_id');
    }

    /**
     * Get the user's favorite announcements.
     */
    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    /**
     * The announcements favorited by the user.
     */
    public function anunciosFavoritados()
    {
        return $this->belongsToMany(Anuncio::class, 'favoritos')
                    ->withTimestamps();
    }

    /**
     * Accessor for the average rating received.
     */
    public function getMediaAvaliacoesAttribute()
    {
        return $this->avaliacoesRecebidas()->avg('nota');
    }
}
