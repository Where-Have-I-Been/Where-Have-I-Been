<?php

declare(strict_types=1);

namespace App\Services\Follow;

use App\Models\User;
use Illuminate\Support\Collection;

interface FollowServiceInterface
{
    public function createFollow(User $follower, User $userToFollow): bool;
    public function deleteFollow(User $loggedUser, User $following): bool;

    public function getFollowers(User $user): Collection;
    public function getFollowing(User $user): Collection;
}
