<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices\RegisterService;

use App\Models\User;
use App\Services\AuthenticationServices\BaseAuthService;

class RegisterService extends BaseAuthService implements RegisterServiceInterface
{
    public function register(array $credentials): void
    {
        $credentials["password"] = $this->hashes->make($credentials["password"]);
        User::create($credentials);
    }
}
