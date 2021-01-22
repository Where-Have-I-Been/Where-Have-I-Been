<?php

declare(strict_types=1);

namespace App\Services\Statistics\Generator;

use App\Services\Statistics\MonthlyReportData;

interface MonthlyReportsGeneratorInterface
{
    public function generate(): MonthlyReportData;
}
