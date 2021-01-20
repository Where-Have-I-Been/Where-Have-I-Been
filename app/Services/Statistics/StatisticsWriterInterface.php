<?php

namespace App\Services\Statistics;

use Ramsey\Collection\Collection;

interface StatisticsWriterInterface
{
    public function write(Collection $statistics): void;

}
