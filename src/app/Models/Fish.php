<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Fish extends Model
{
    protected $table = 'fishes';

    protected $fillable = [
        'region_id',
        'user_id',
        'name',
        'slug',
        'scientific_name',
        'image',
        'description',
        'characteristics',
        'habitat',
        'average_weight',
        'status',
        'biogeography',
    ];

    protected static function booted(): void
    {
        static::creating(function (Fish $fish) {
            if (blank($fish->slug)) {
                $fish->slug = Str::slug($fish->name);
            }
        });

        static::updating(function (Fish $fish) {
            if (blank($fish->slug)) {
                $fish->slug = Str::slug($fish->name);
            }
        });
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
