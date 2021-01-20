<?php

namespace App\Services\Statistics;

interface StatisticsGeneratorInterface
{
    public function generate(): ReportData;
}
