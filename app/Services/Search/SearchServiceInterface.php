<?php

declare(strict_types=1);

namespace App\Services\Search;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SearchServiceInterface
{
    public function searchTrips(string $searchRequest, ?string $perPage): LengthAwarePaginator;
}
