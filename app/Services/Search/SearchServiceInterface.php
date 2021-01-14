<?php

declare(strict_types=1);

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;

interface SearchServiceInterface
{
    public function searchTrips(string $searchRequest): Collection;
}
