<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    protected $fillable = ['brand_id', 'api_id', 'name'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function years(): HasMany
    {
        return $this->hasMany(ModelYear::class);
    }
}

