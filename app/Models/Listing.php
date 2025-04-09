<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'user_id', 'model_year_id', 'price', 'description',
        'location', 'mileage', 'color', 'is_active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function modelYear(): BelongsTo
    {
        return $this->belongsTo(ModelYear::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ListingPhoto::class);
    }

    public function mainPhoto()
    {
        return $this->photos()->where('is_main', true)->first();
    }
}
