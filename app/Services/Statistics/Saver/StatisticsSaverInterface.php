<?php

declare(strict_types=1);

namespace App\Services\Statistics\Saver;

interface StatisticsSaverInterface
{
    public function saveMonthlyReport(): void;
}
