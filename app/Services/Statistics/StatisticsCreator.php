<?php

namespace App\Services\Statistics;

use App\Models\StatisticsReport;

class StatisticsCreator implements StatisticsCreatorInterface
{
    private StatisticsGeneratorInterface $generator;

    public function __construct(StatisticsGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }


    public function save(): void
    {
        $data = $this->generator->generate();
        $report = new StatisticsReport();
        $report->data = json_encode($data);
        $report->save();
    }
}
