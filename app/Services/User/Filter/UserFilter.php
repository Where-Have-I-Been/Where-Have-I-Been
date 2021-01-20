<?php

declare(strict_types=1);

namespace App\Services\User\Filter;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

class UserFilter implements UserFilterInterface
{
    public function filterUsers(QueryStringData $data, User $user): Builder
    {
        $query = User::query();

        if ($data->isToBeSearch()) {
            $query = $query->search($data->searchQuery);
        }
        if ($data->byFollowings) {
            $query = $query->byFollowings($user);
        }
        if ($data->byFollowers) {
            $query = $query->byFollowers($user);
        }

        return $query;
    }
}
