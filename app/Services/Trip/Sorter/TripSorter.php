<?php

declare(strict_types=1);

namespace App\Services\Trip\Sorter;

use App\Models\User;
use App\Services\Like\LikeServiceInterface;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TripSorter implements TripSorterInterface
{
    public function sort(Builder $query, QueryStringData $data): Collection
    {
        if ($data->sortByLikes) {
            $service = app(LikeServiceInterface::class);
            return $service->sortByLikes($query, User::class);
        }
        if ($data->sortByUpdated) {
            return $query->orderBy("updated_at")->get();
        }
        if ($data->sortByCreated) {
            return $query->orderBy("created_at")->get();
        }

        return $query->get();
    }
}
