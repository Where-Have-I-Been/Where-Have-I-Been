<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Photo extends Model
{
    protected $table = "photos";

    protected $fillable = [
        "path",
        "user_id"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($photo) {
            $photo->{$photo->getKeyName()} = (string) Str::uuid();
        });
    }

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
}
