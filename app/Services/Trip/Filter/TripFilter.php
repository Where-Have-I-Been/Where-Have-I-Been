<?php

declare(strict_types=1);

namespace App\Services\Trip\Filter;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TripFilter implements TripFilterInterface
{
    public function filterTrips(array $filters, User $user): Builder
    {
        $query = Trip::query();

        if (array_key_exists("city", $filters)) {
            $query = $query->byCity($filters["city"]);
        }
        if (array_key_exists("country", $filters)) {
            $query = $query->byCountry($filters["country"]);
        }
        if (array_key_exists("only-followings", $filters) && $filters["only-followings"] === "true") {
            $query = $query->byFollowings($user);
        }
        if (array_key_exists("only-liked", $filters) && $filters["only-liked"] === "true") {
            $query = $query->likedBy($user);
        }

        return $query;
    }
}
