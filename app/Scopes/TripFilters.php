<?php

declare(strict_types=1);

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait TripFilters
{
    public function scopeByCity(Builder $query, string $city): Builder
    {
        return $query->whereHas("places", function ($query) use ($city): void {
            $query->where("city", $city);
        });
    }

    public function scopeByCountry(Builder $query, string $country): Builder
    {
        return $query->whereHas("places", function ($query) use ($country): void {
            $query->where("country", $country);
        });
    }
}
