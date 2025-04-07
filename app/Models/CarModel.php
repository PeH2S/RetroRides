<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    protected $fillable = ['brand_id','api_id', 'name'];
    protected $table = 'carmodels';

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

