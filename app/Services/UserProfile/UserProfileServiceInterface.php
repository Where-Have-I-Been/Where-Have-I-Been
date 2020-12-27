<?php

declare(strict_types=1);

namespace App\Services\UserProfile;

use App\Http\Resources\ProfileResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): UserProfile;
    public function getProfile(UserProfile $profile, User $user, ?string $representation): UserProfile;
}
