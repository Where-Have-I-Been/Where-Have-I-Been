<?php

declare(strict_types=1);

namespace App\Services\Statistics;

use App\Services\Helpers\ArrayKeyHelperInterface;

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
        $arrayKeyHelper = app(ArrayKeyHelperInterface::class);
        $this->mostVisitedCities = $arrayKeyHelper->addIncrementsKeys($mostVisitedCities);
        $this->mostVisitedCountries = $arrayKeyHelper->addIncrementsKeys($mostVisitedCountries);
        $this->mostLikedTrips = $mostLikedTrips;
        $this->theBiggestTrips = $theBiggestTrips;
        $this->byNationality = $byNationality;
        $this->maleTripsCount = $maleTripsCount;
        $this->femaleTripsCount = $femaleTripsCount;
    }
}
