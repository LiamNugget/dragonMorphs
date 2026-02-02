<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['dragon_id', 'image_path', 'is_primary', 'order'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function dragon(): BelongsTo
    {
        return $this->belongsTo(Dragon::class);
    }
}