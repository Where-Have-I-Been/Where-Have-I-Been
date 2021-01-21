<?php

declare(strict_types=1);

namespace App\Services\Statistics;

use App\Models\Place;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Symplify\EasyCodingStandard\SniffRunner\Exception\File\NotImplementedException;

class MonthlyReportsGenerator implements MonthlyReportsGeneratorInterface
{
    public function generate(): MonthlyReportData
    {
        $cities = $this->getMostVisitedCities(10);
        $countries = $this->getMostVisitedCountries(10);
        $mostLikedTrips = $this->getMostLikedTrips(5);
        $theBiggestTrips = $this->getBiggestTrips(5);
        //   $nationality = $this->getMostTravelingNationalities(5);
        $maleTrips = $this->getTripsCountByGender("male");
        $femaleTrips = $this->getTripsCountByGender("female");

        return new MonthlyReportData($cities, $countries, $mostLikedTrips, $theBiggestTrips, [], $maleTrips, $femaleTrips);
    }

    private function getMostVisitedCities(int $amount): array
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

    private function getMostVisitedCountries(int $amount): array
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

    private function getMostLikedTrips(int $amount)
    {
        return Trip::query()
            ->orderByDesc("likes_count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    private function getBiggestTrips(int $amount): array
    {
        return Trip::query()
            ->withCount("places")
            ->get()
            ->sortByDesc("places_count")
            ->take($amount)
            ->toArray();
    }

    private function getMostTravelingNationalities(int $amount): array
    {
        throw new NotImplementedException();
    }

    private function getTripsCountByGender(string $gender): int
    {
        return Trip::query()->whereHas("user", function (Builder $query) use ($gender): void {
            $query->whereHas("userProfile", function (Builder $query) use ($gender): void {
                $query->where("gender", $gender);
            });
        })->count();
    }
}
