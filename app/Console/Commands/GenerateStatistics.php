<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Statistics\Saver\StatisticsSaverInterface;
use Illuminate\Console\Command;

class GenerateStatistics extends Command
{
    protected $signature = "statistics:generate";

    private StatisticsSaverInterface $creator;

    public function __construct(StatisticsSaverInterface $creator)
    {
        parent::__construct();

        $this->creator = $creator;
    }

    public function handle(): void
    {
        $this->creator->saveMonthlyReport();
    }
}
