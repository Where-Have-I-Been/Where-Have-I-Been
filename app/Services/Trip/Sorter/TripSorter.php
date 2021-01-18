<?php

declare(strict_types=1);

namespace App\Services\Trip\Sorter;

use App\Exceptions\ApiException;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

class TripSorter implements TripSorterInterface
{
    public function sort(Builder $query, QueryStringData $data): Builder
    {
        if ($data->sortByLikes) {
            return $query->orderByDesc("likes_count");
        }
        if ($data->sortByUpdated) {
            return $query->orderBy("updated_at");
        }
        if ($data->sortByCreated) {
            return $query->orderBy("created_at");
        }
        throw new ApiException("Invalid sort parameter");
    }
}
