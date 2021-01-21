<?php

declare(strict_types=1);

namespace App\Services\Statistics;

interface MonthlyReportsGeneratorInterface
{
    public function generate(): MonthlyReportData;
}
