<?php

namespace App\Services\Statistics;

use App\Models\Place;

class StatisticsGenerator implements StatisticsGeneratorInterface
{
    public function generate(): ReportData
    {
        $cities = (array) Place::query()->mostVisitedCities(10)->get();
        $countries = (array) Place::query()->mostVisitedCountries(10)->get();
        return  new ReportData($cities, $countries);
    }

}
