<?php

declare(strict_types=1);

namespace App\Services\Statistics\Provider;

interface StatisticsDataProviderInterface
{
    public function getMostVisitedCities(int $amount): array;
    public function getMostVisitedCountries(int $amount): array;
    public function getMostLikedTrips(int $amount);
    public function getBiggestTrips(int $amount): array;
    public function getMostTravelingNationalities(int $amount): array;
    public function getTripsCountByGender(string $gender): int;
}
