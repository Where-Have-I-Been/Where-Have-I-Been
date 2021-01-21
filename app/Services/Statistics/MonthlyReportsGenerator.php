<?php

namespace App\Services\Statistics;

use App\Models\Country;
use App\Models\Place;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MonthlyReportsGenerator implements MonthlyReportsGeneratorInterface
{
    public function generate(): MonthlyReportData
    {
        $cities = (array) $this->getMostVisitedCities(10);
        $countries = (array) $this->getMostVisitedCountries(10);
        $mostLikedTrips = (array) $this->getMostLikedTrips(5);
        $theBiggestTrips = (array) $this->getBiggestTrips(5);
      //  $nationality = $this->getMostTravelingNationalities(5);
        $maleTrips =  $this->getTripsCountByGender("male");
        $femaleTrips =  $this->getTripsCountByGender("female");

        return  new MonthlyReportData([], [], [], [],[],$maleTrips,$femaleTrips);
    }

    private function getMostVisitedCities(int $amount): Collection
    {
        return Place::query()->where("created_at",">",now()->addMonths(-1))
            ->select("city")
            ->groupBy("city")
            ->orderByRaw("COUNT(*) DESC")
            ->selectRaw("COUNT(*) as count")
            ->take($amount)
            ->get();
    }

    private function getMostVisitedCountries(int $amount): Collection
    {
        return Place::query()->where("created_at",">",now()->addMonths(-1))
            ->select("country")
            ->groupBy("country")
            ->orderByRaw("COUNT(*) DESC")
            ->selectRaw("COUNT(*) as count")
            ->take($amount)
            ->get();
    }

    private function getMostLikedTrips(int $amount)
    {
        return Trip::query()
            ->orderByDesc("likes_count")
            ->take($amount)
            ->get()
            ->toArray();
    }

    private function getBiggestTrips(int $amount)
    {
        return Trip::query()
            ->withCount("places")
            ->get()
            ->sortByDesc("places_count")
            ->take($amount)
            ->toArray();
    }

    private function getMostTravelingNationalities(int $amount)
    {
        return Country::query()
            ->with("usersProfiles")
            ->with("users")
            ->withCount("trips")->get()
            ->take($amount)->toArray();
    }

    private function getTripsCountByGender(string $gender)
    {
        return Trip::query()->whereHas("user", function (Builder $query) use ($gender): void {
            $query->whereHas("userProfile", function (Builder $query) use ($gender): void {
                $query->where("gender", $gender);
            });
        })->count();
    }
}
