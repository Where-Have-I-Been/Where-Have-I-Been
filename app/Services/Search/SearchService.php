<?php

namespace App\Services\Search;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class SearchService implements SearchServiceInterface
{
    public function searchTrips(string $searchRequest): Collection
    {
        return Trip::search($searchRequest)->where("published",1)->get();
    }
}
