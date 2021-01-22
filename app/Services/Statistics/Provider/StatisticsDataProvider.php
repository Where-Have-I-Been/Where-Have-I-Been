<?php

declare(strict_types=1);

namespace App\Services\Statistics\Provider;

use App\Models\Country;
use App\Models\Place;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatisticsDataProvider implements StatisticsDataProviderInterface
{
    public function getMostVisitedCities(int $amount): array
    {
        return Place::query()->where("created_at", ">", now()->addMonths(-1))
            ->select("city")
            ->groupBy("city")
            ->orderByRaw("COUNT(*) DESC")
            ->selectRaw("COUNT(*) as count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    public function getMostVisitedCountries(int $amount): array
    {
        return Place::query()->where("created_at", ">", now()->addMonths(-1))
            ->select("country")
            ->groupBy("country")
            ->orderByRaw("COUNT(*) DESC")
            ->selectRaw("COUNT(*) as count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    public function getMostLikedTrips(int $amount)
    {
        return $this->getRequiredTripData()
            ->orderByDesc("likes_count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    public function getBiggestTrips(int $amount): array
    {
        return $this->getRequiredTripData()
            ->withCount("places")
            ->orderByDesc("places_count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    public function getMostTravelingNationalities(int $amount): array
    {
        return Country::query()
            ->withCount("trips")
            ->orderByDesc("trips_count")
            ->take(10)
            ->get()
            ->toArray();
    }

    public function getTripsCountByGender(string $gender): int
    {
        return $this->getRequiredTripData()->whereHas("user", function (Builder $query) use ($gender): void {
            $query->whereHas("userProfile", function (Builder $query) use ($gender): void {
                $query->where("gender", $gender);
            });
        })->count();
    }

    private function getRequiredTripData(): Builder
    {
        return Trip::query()
            ->select("id", "name", "likes_count", "photo_id")
            ->with(
            [
                "photo" => function (BelongsTo $query): void {
                    $query->select("id", "path");
                },
            ]);
    }
}
