<?php

namespace App\Services\Statistics;

use App\Models\StatisticsReport;

class StatisticsGetter implements StatisticsGetterInterface
{
    public function getStatistics(string $month,string $year)
    {
        return StatisticsReport::query()
            ->whereYear("created_at","=", $year)
            ->whereMonth("created_at","=",$month)->first()->get();
    }
}
