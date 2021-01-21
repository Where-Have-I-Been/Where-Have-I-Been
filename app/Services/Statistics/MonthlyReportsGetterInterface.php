<?php

declare(strict_types=1);

namespace App\Services\Statistics;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MonthlyReportsGetterInterface
{
    public function getMonthlyReports(string $perPage): LengthAwarePaginator;
}
