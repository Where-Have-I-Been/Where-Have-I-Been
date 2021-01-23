<?php

declare(strict_types=1);

namespace App\Services\Follow;

use App\Events\NewFollowEvent;
use App\Exceptions\ResourceException;
use App\Models\User;
use Illuminate\Support\Collection;

class FollowService implements FollowServiceInterface
{
    public function createFollow(User $loggedUser, User $following): void
    {
        $result = $loggedUser->follow($following);

        if ($result === false) {
            throw new ResourceException(__("resources.exists"));
        }
        event(new NewFollowEvent($loggedUser,$following));
    }

    public function deleteFollow(User $loggedUser, User $following): void
    {
        $result = $loggedUser->unfollow($following);

        if ($result === false) {
            throw new ResourceException(__("resources.not_exist"));
        }
    }

    public function getFollowers(User $user): Collection
    {
        return $user->followers()->get();
    }

    public function getFollowing(User $user): Collection
    {
        return $user->following()->get();
    }
}
