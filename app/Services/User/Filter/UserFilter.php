<?php

declare(strict_types=1);

namespace App\Services\User\Filter;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rennokki\Befriended\Models\FollowerModel;

class UserFilter implements UserFilterInterface
{
    public function filterUsers(QueryStringData $data, User $user): MorphToMany
    {
        $query = FollowerModel::query();

        if ($data->byFollowings) {
            $query = $user->following();
        }
        if ($data->byFollowers) {
            $query = $user->followers();
        }
        if ($data->isToBeSearch()) {
            $query = $query->search($data->searchQuery);
        }
        return $query;
    }
}
