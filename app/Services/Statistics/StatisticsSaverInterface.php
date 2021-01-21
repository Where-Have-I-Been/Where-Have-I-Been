<?php

namespace App\Services\Statistics;

interface StatisticsSaverInterface
{
    public function saveMonthlyReport(): void;
}
