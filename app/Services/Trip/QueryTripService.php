<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class QueryTripService implements QueryTripServiceInterface
{
    public function getTrips(array $filtersParameters, ?string $sortParameter, User $user): Collection
    {
        $query = $this->filterTrips($filtersParameters, $user);
        return $this->sort($query, $sortParameter);
    }

    public function searchTrips(string $searchRequest): Collection
    {
        return Trip::search($searchRequest)->where("published",1)->get();
    }

    private function filterTrips(array $filtersParameters, User $user): Builder
    {
        $query = Trip::query();

        if ($filtersParameters["city"] !== null) {
            $query = Trip::City($filtersParameters["city"]);
        }
        if ($filtersParameters["only-followings"] == true) {
            $query = Trip::followings($user);
        }
        if ($filtersParameters["only-liked"] == true) {
            $query = Trip::likedBy($user);
        }

        return $query;
    }

    private function sort(Builder $query, ?string $sortParameter): Collection
    {
       if ($sortParameter == "likes") {
            return $this->sortByLikes($query);
        }
        else if ($sortParameter == "updated") {
            return $query->orderBy("updated_at")->get();
        }
        else if ($sortParameter == "created") {
            return $query->orderBy("created_at")->get();
        }
        else {
            return $query->get();
        }
    }

    private function sortByLikes(Builder $query): Collection
    {
        return $query->with("likers")->get()->sortBy(function ($trip) {
            return $trip->likers(User::class)->count();
        })->reverse();
    }
}
