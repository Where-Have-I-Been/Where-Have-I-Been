<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices\PasswordService;

use App\Models\User;

interface PasswordServiceInterface
{
    public function changePassword(array $data, User $user): void;
}
