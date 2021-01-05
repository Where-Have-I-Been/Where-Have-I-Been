<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Photo extends Model
{
    protected $table = "photos";

    protected $fillable = [
        "path",
        "name",
        "user_id",
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function usersProfiles(): HasMany
    {
        return $this->HasMany(UserProfile::class);
    }

    public function trips(): HasMany
    {
        return $this->HasMany(Trip::class);
    }

    public function placePhotos(): HasMany
    {
        return $this->HasMany(PlacePhoto::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($photo): void {
            $photo->{$photo->getKeyName()} = (string)Str::uuid();
        });
    }
}
