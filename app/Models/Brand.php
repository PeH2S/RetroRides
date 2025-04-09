<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['api_id', 'name'];

    /**
     * Relacionamento com os modelos de carro
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
