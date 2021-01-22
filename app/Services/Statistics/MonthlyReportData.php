<?php

declare(strict_types=1);

namespace App\Services\Statistics;

use App\Services\Helpers\ArrayKeyHelper;

class MonthlyReportData
{
    public array $mostVisitedCities;
    public array $mostVisitedCountries;
    public array $mostLikedTrips;
    public array $theBiggestTrips;
    public array $mostTravelingNationalities;
    public int $maleTripsCount;
    public int $femaleTripsCount;

    public function prepareToSave(): self
    {
        $this->mostLikedTrips = $this->addUrlFromPath($this->mostLikedTrips);
        $this->theBiggestTrips = $this->addUrlFromPath($this->theBiggestTrips);
        $this->addKeys();

        return $this;
    }

    private function addUrlFromPath(array $data): array
    {
        foreach ($data as &$element) {
            if (array_key_exists("photo", $element) && isset($element["photo"]["path"])) {
                $element["photo"]["path"] = asset($element["photo"]["path"]);
            }
        }

        return $data;
    }

    private function addKeys(): void
    {
        $arrayKeyHelper = app(ArrayKeyHelper::class);
        $this->mostVisitedCities = $arrayKeyHelper->addIncrementsKeys($this->mostVisitedCities);
        $this->mostLikedTrips = $arrayKeyHelper->addIncrementsKeys($this->mostLikedTrips);
        $this->theBiggestTrips = $arrayKeyHelper->addIncrementsKeys($this->theBiggestTrips);
        $this->mostTravelingNationalities = $arrayKeyHelper->addIncrementsKeys($this->mostTravelingNationalities);
    }
}
