<?php

declare(strict_types=1);

namespace App\Services\UserProfile;

use App\Models\User;
use App\Models\UserProfile;

interface UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): UserProfile;
    public function getProfile(UserProfile $profile, User $user, ?string $representation): UserProfile;
}
