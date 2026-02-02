<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dragon extends Model
{
    protected $fillable = [
        'name',
        'sex',
        'dob',
        'morph',
        'weight',
        'price',
        'status',
        'is_hidden',
        'parent_male_id',
        'parent_female_id',
        'clutch_id',
        'description',
        'notes',
        'date_listed',
        'date_sold'
    ];

    protected $casts = [
        'dob' => 'date',
        'date_listed' => 'date',
        'date_sold' => 'date',
        'is_hidden' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('order');
    }

    public function primaryImage()
    {
        return $this->hasOne(Image::class)->where('is_primary', true);
    }

    public function parentMale(): BelongsTo
    {
        return $this->belongsTo(Dragon::class, 'parent_male_id');
    }

    public function parentFemale(): BelongsTo
    {
        return $this->belongsTo(Dragon::class, 'parent_female_id');
    }

    public function getAgeAttribute()
    {
        return $this->dob->diffForHumans(['parts' => 2]);
    }
}
