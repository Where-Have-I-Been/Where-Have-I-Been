<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Services\Like\LikeServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class QueryTripService implements QueryTripServiceInterface
{
    public function getTrips(array $filtersParameters, ?string $sortParameter, User $user): Collection
    {
        $query = $this->filterTrips($filtersParameters, $user);
        return $this->sortTrips($query, $sortParameter);
    }

    private function filterTrips(array $filtersParameters, User $user): Builder
    {
        $query = Trip::query();

        if ($filtersParameters["city"] !== null) {
            $query = $query->byCity($filtersParameters["city"]);
        }
        if ($filtersParameters["country"] !== null) {
            $query = $query->byCountry($filtersParameters["country"]);
        }
        if ($filtersParameters["only-followings"] === true) {
            $query = $query->byFollowings($user);
        }
        if ($filtersParameters["only-liked"] === true) {
            $query = $query->likedBy($user);
        }

        return $query;
    }

    private function sortTrips(Builder $query, ?string $sortParameter): Collection
    {
        if ($sortParameter === "likes") {
            $service = app(LikeServiceInterface::class);
            return $service->sortByLikes($query, User::class);
        }
        if ($sortParameter === "updated") {
            return $query->orderBy("updated_at")->get();
        }
        if ($sortParameter === "created") {
            return $query->orderBy("created_at")->get();
        }

        return $query->get();
    }
}
