<?php

declare(strict_types=1);

namespace App\Services\UserProfileService;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserProfileServiceInterface
{
    public function updateProfile(UserProfile $profile, array $data): void;
    public function getProfile(UserProfile $profile, User $user, ?string $representation): JsonResource;
}
