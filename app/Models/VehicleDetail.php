<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDetail extends Model
{
    protected $fillable = [
        'model_year_id',
        'fipe_code',
        'fuel',
        'fuel_acronym',
        'price',
        'model_year',
        'reference_month'
    ];

    public function modelYear(): BelongsTo
    {
        return $this->belongsTo(ModelYear::class);
    }
}
