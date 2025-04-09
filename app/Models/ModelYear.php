<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ModelYear extends Model
{
    protected $fillable = ['car_model_id', 'code', 'year'];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function detail(): HasOne
    {
        return $this->hasOne(VehicleDetail::class);
    }
}
