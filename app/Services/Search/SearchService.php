<?php

declare(strict_types=1);

namespace App\Services\Search;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class SearchService
{
    public function searchTrips(string $searchRequest): Collection
    {
        return Trip::search($searchRequest)->get();
    }
}
