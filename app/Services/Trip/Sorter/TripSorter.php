<?php

declare(strict_types=1);

namespace App\Services\Trip\Sorter;

use App\Models\User;
use App\Services\Like\LikeServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TripSorter implements TripSorterInterface
{
    public function sort(Builder $query, ?string $sortBy): Collection
    {
        if ($sortBy === "likes") {
            $service = app(LikeServiceInterface::class);
            return $service->sortByLikes($query, User::class);
        }
        if ($sortBy === "updated") {
            return $query->orderBy("updated_at")->get();
        }
        if ($sortBy === "created") {
            return $query->orderBy("created_at")->get();
        }

        return $query->get();
    }
}
