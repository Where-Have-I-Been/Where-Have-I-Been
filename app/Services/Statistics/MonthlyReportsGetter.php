<?php

namespace App\Services\Statistics;

use App\Models\StatisticsReport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MonthlyReportsGetter implements MonthlyReportsGetterInterface
{
    public function getMonthlyReports(string $perPAge): LengthAwarePaginator
    {
        return StatisticsReport::query()
            ->first()
            ->paginate($perPAge);
    }
}
