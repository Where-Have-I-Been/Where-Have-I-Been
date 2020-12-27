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

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($photo): void {
            $photo->{$photo->getKeyName()} = (string)Str::uuid();
        });
    }
}
