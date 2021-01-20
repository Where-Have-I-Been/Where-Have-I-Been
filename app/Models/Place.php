<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    public function scopeMostVisitedCities(Builder $query, int $amount): Builder
    {
        return $query->where("created_at","<",now()->addMonths(-1))
            ->select("city")
            ->groupBy("city")
            ->orderByRaw("COUNT(*) DESC")
            ->take($amount);
    }

    public function scopeMostVisitedCountries(Builder $query, int $amount): Builder
    {
        return $query->where("created_at","<",now()->addMonths(-1))
            ->select("country")
            ->groupBy("country")
            ->orderByRaw("COUNT(*) DESC")
            ->take($amount);
    }
}
