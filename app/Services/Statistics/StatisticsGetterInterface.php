<?php

namespace App\Services\Statistics;

use App\Models\StatisticsReport;

interface StatisticsGetterInterface
{
    public function getStatistics(string $month, string $year);
}
