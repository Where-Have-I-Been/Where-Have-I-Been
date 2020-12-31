<?php

declare(strict_types=1);

namespace App\Services\Follow;

use App\Models\User;
use App\Services\UserProfile\UserProfileServiceInterface;
use Illuminate\Support\Collection;

class FollowService implements FollowServiceInterface
{
    private UserProfileServiceInterface $profileService;

    public function __construct(UserProfileServiceInterface $service)
    {
        $this->profileService = $service;
    }

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
        $followers = $user->followers()->get();
        return $this->profileService->getPublicProfiles($followers);
    }

    public function getFollowing(User $user): Collection
    {
        $following = $user->following()->get();
        return $this->profileService->getPublicProfiles($following);
    }
}
