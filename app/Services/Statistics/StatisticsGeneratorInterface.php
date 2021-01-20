<?php


namespace App\Services\Statistics;


use Ramsey\Collection\Collection;

interface StatisticsGeneratorInterface
{
    public function generate(): Collection;
}
