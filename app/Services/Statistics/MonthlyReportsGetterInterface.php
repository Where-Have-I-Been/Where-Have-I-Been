<?php

namespace App\Services\Statistics;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MonthlyReportsGetterInterface
{
    public function getMonthlyReports(string $perPage): LengthAwarePaginator;
}
