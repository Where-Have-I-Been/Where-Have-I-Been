<?php

namespace App\Services\Statistics;

class MonthlyReportData
{
    public array $mostVisitedCities;
    public array $mostVisitedCountries;
    public array $mostLikedTrips;
    public array $theBiggestTrips;
    public array $byNationality;
    public int $maleTripsCount;
    public int $femaleTripsCount;


    public function __construct(array $mostVisitedCities, array $mostVisitedCountries,
                                array $mostLikedTrips, array $theBiggestTrips,
                                array $byNationality, int $maleTripsCount, int $femaleTripsCount)
    {
        $this->mostVisitedCities = $this->changeKeysForIncrements($mostVisitedCities,"city");
        $this->mostVisitedCountries = $this->changeKeysForIncrements($mostVisitedCountries,"country");
        $this->mostLikedTrips = $mostLikedTrips;
        $this->theBiggestTrips = $theBiggestTrips;
        $this->byNationality = $byNationality;
        $this->maleTripsCount = $maleTripsCount;
        $this->femaleTripsCount = $femaleTripsCount;

    }

    private function changeKeysForIncrements(array $data, string $key)
    {
        $newData = array();

        $index = 1;
        foreach ($data as $element) {
            $newData+=["position_$index" => $element];
            $index++;
        }
        return $newData;
    }
}
