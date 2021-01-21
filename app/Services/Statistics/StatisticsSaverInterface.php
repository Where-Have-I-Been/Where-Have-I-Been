<?php

declare(strict_types=1);

namespace App\Services\Statistics;

interface StatisticsSaverInterface
{
    public function saveMonthlyReport(): void;
}
