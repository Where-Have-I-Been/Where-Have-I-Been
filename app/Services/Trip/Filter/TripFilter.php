<?php

declare(strict_types=1);

namespace App\Services\Trip\Filter;

use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

class TripFilter implements TripFilterInterface
{
    public function filterTrips(QueryStringData $data, User $user): Builder
    {
        $query = Trip::query();

        if ($data->byCity()) {
            $query = $query->byCity($data->city);
        }
        if ($data->byCountry()) {
            $query = $query->byCountry($data->country);
        }
        if ($data->onlyByFollowings) {
            $query = $query->byFollowings($user);
        }
        if ($data->onlyByLiked) {
            $query = $query->likedBy($user);
        }

        return $query;
    }
}
