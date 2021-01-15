<?php

declare(strict_types=1);

namespace App\Services\Trip\Sorter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface TripSorterInterface
{
    public function sort(Builder $query, ?string $sortBy): Collection;
}
