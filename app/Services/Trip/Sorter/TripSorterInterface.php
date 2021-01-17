<?php

declare(strict_types=1);

namespace App\Services\Trip\Sorter;

use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface TripSorterInterface
{
    public function sort(Builder $query, QueryStringData $data): Collection;
}
