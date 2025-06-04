<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Se quiser proteção pela massa (mass assignment), coloque:
    protected $fillable = [
        'user_id',
        'cep',
        'state',
        'city',
    ];

    // Relacionamento inverso: um Address pertence a um User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
