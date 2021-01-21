<?php

namespace App\Console\Commands;

use App\Services\Statistics\StatisticsSaverInterface;
use Illuminate\Console\Command;

class GenerateStatistics extends Command
{
    protected $signature = "statistics:generate";

    private StatisticsSaverInterface $creator;

    function __construct(StatisticsSaverInterface $creator)
    {
        parent::__construct();
        $this->creator = $creator;
    }


    public function handle()
    {
        $this->creator->saveMonthlyReport();
    }
}
