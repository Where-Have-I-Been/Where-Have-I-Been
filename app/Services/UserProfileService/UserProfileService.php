<?php

declare(strict_types=1);

namespace App\Services\UserProfileService;

use App\Http\Resources\PrivateProfileResource;
use App\Http\Resources\PublicProfileResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileService implements UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): void
    {
        $profile->update($data);
    }

    public function getProfile(UserProfile $profile, User $user, ?string $representation): JsonResource
    {
        if (!$this->isThisLoggedUserProfile($profile, $user) && $representation === "private") {
            throw new AuthorizationException("You don't have access to this representation");
        } elseif ($representation === "private") {
            return new PrivateProfileResource($profile);
        }
        return new PublicProfileResource($profile);
    }

    private function isThisLoggedUserProfile(UserProfile $profile, User $user): bool
    {
        return $profile->user()->first()->is($user);
    }
}
