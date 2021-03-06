<?php

declare(strict_types=1);

namespace App\Services\Authentication\Password;

use App\Models\User;

interface PasswordServiceInterface
{
    public function changePassword(array $data, User $user): void;
}
