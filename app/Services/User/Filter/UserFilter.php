<?php

namespace App\Services\User\Filter;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

class UserFilter implements UserFilterInterface
{
    public function filterTrips(QueryStringData $data, User $user): Builder
    {
        $query = User::query();

        if ($data->byFollowings) {
            $query = $query->byFollowings($user);
        }
        if ($data->byFriends) {
            $query = $query->byFriends($user);
        }
        if ($data->isToBeSearch()) {
            $query = $query->search($user);
        }
        return $query;
    }
}
