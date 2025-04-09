<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingPhoto extends Model
{
    protected $fillable = ['listing_id', 'path', 'is_main'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
