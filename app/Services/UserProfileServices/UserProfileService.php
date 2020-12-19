<?php

declare(strict_types=1);

namespace App\Services\UserProfileServices;

use App\Http\Resources\PublicProfileResource;
use App\Http\Resources\PrivateProfileResource;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\Interfaces\UserProfileServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileService implements UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): void
    {
        $profile->update($data);
        $profile->save();
    }

    public function getProfile(UserProfile $profile, ?User $user): JsonResource
    {
        if ($user != null && $this->isThisLoggedUserProfile($profile, $user)) {
            return new PrivateProfileResource($profile);
        }

        return new PublicProfileResource($profile);
    }

    private function isThisLoggedUserProfile(UserProfile $profile, User $user ): bool
    {
        return $profile->user()->first()->is($user);
    }

}
