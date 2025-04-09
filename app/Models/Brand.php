<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['api_id', 'name'];

    public function brand(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}

