<?php

declare(strict_types=1);

namespace App\Services\Follow;

use App\Models\User;
use Illuminate\Support\Collection;

class FollowService implements FollowServiceInterface
{
    public function createFollow(User $loggedUser, User $following): bool
    {
        return $loggedUser->follow($following);
    }

    public function deleteFollow(User $loggedUser, User $following): bool
    {
        return $loggedUser->unfollow($following);
    }

    public function getFollowers(User $user): Collection
    {
       return $followers = $user->followers()->get();
    }

    public function getFollowing(User $user): Collection
    {
      return  $following = $user->following()->get();
    }
}
