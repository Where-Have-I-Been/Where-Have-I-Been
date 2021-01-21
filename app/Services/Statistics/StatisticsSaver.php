<?php

namespace App\Services\Statistics;

use App\Http\Resources\MonthlyReportCollection;
use App\Models\StatisticsReport;

class StatisticsSaver implements StatisticsSaverInterface
{
    private MonthlyReportsGeneratorInterface $generator;

    public function __construct(MonthlyReportsGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function saveMonthlyReport(): void
    {
        $data = $this->generator->generate();
        $report = new StatisticsReport();
        $report->data = $data;
        $report->save();
    }
}
