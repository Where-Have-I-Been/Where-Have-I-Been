<?php

namespace App\Console\Commands;

use App\Services\Statistics\StatisticsCreatorInterface;
use Illuminate\Console\Command;

class GenerateStatistics extends Command
{
    protected $signature = "statistics:generate";

    private StatisticsCreatorInterface $creator;

    function __construct(StatisticsCreatorInterface $creator)
    {
        parent::__construct();
        $this->creator = $creator;
    }


    public function handle()
    {
        $this->creator->save();
    }
}
