<?php

declare(strict_types=1);

namespace App\Services\Statistics\Generator;

use App\Services\Statistics\MonthlyReportData;
use App\Services\Statistics\Provider\StatisticsDataProviderInterface;

class MonthlyReportsGenerator implements MonthlyReportsGeneratorInterface
{
    private StatisticsDataProviderInterface $dataProvider;

    public function __construct(StatisticsDataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function generate(): MonthlyReportData
    {
        $data = new MonthlyReportData();
        $data->mostVisitedCities = $this->dataProvider->getMostVisitedCities(10);
        $data->mostVisitedCountries = $this->dataProvider->getMostVisitedCountries(10);
        $data->mostLikedTrips = $this->dataProvider->getMostLikedTrips(5);
        $data->theBiggestTrips = $this->dataProvider->getBiggestTrips(5);
        $data->mostTravelingNationalities = $this->dataProvider->getMostTravelingNationalities(5);
        $data->maleTripsCount = $this->dataProvider->getTripsCountByGender("male");
        $data->femaleTripsCount = $this->dataProvider->getTripsCountByGender("female");

        return $data->prepareToSave();
    }
}
