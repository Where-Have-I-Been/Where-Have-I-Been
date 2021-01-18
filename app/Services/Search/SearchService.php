<?php

declare(strict_types=1);

namespace App\Services\Search;

use App\Models\Trip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchService implements SearchServiceInterface
{
    public function searchTrips(string $searchRequest, ?string $perPage): LengthAwarePaginator
    {
        return Trip::query()
            ->where("name", "like", "%{$searchRequest}%")
            ->paginate($perPage);
    }
}
