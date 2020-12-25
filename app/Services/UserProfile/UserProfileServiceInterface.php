<?php

declare(strict_types=1);

namespace App\Services\UserProfile;

use App\Http\Resources\PrivateProfileResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): PrivateProfileResource;
    public function getProfile(UserProfile $profile, User $user, ?string $representation): JsonResource;
}
