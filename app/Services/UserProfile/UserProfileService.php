<?php

declare(strict_types=1);

namespace App\Services\UserProfile;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\AuthorizationException;

class UserProfileService implements UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): UserProfile
    {
        $profile->update($data);

        return $profile;
    }

    public function getProfile(UserProfile $profile, User $user, ?string $representation): UserProfile
    {
        if (!$this->isThisLoggedUserProfile($profile, $user) && $representation === "private") {
            throw new AuthorizationException(__("resources.access_denied"));
        } elseif ($representation === "private") {
            return $profile;
        }

        return $this->getPublicProfile($profile);
    }

    private function isThisLoggedUserProfile(UserProfile $profile, User $user): bool
    {
        return $profile->user()->first()->is($user);
    }

    private function getPublicProfile(UserProfile $profile): UserProfile
    {
        $publicProfileData = $profile->makeHidden("birth_date")->toArray();
        return new UserProfile($publicProfileData);
    }
}
