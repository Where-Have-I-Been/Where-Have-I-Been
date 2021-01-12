<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;

interface SearchServiceInterface
{
    public function searchTrips(string $searchRequest): Collection;
}
