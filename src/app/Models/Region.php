<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Region extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
    ];

    protected static function booted(): void
    {
        static::creating(function (Region $region) {
            if (blank($region->slug)) {
                $region->slug = Str::slug($region->name);
            }
        });

        static::updating(function (Region $region) {
            if (blank($region->slug)) {
                $region->slug = Str::slug($region->name);
            }
        });
    }

    public function fishes(): HasMany
    {
        return $this->hasMany(Fish::class);
    }
}
