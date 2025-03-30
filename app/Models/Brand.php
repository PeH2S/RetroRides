<?php

namespace App\Models;

use iluminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fiilable = ['api_id', 'name'];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }
}

