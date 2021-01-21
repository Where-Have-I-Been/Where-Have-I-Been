<?php

namespace App\Services\Statistics;

interface MonthlyReportsGeneratorInterface
{
    public function generate(): MonthlyReportData;
}
