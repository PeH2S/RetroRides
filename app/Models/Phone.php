<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'show_phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
