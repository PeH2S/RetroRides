<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    protected $fiilable = ['brand_id','api_id', 'name'];
    protected $table = 'models';

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

