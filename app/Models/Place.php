<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    protected $table = "places";

    protected $fillable = [
        "user_id",
        "trip_id",
        "country",
        "name",
        "description",
        "city",
        "lng",
        "lat",
    ];

    public function trip(): BelongsTo
    {
        return $this->BelongsTo(Trip::class);
    }

    public function country(): BelongsTo
    {
        return $this->BelongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function placePhotos(): HasMany
    {
        return $this->HasMany(PlacePhoto::class);
    }
}
