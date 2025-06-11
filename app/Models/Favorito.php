<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'anuncio_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }
}
