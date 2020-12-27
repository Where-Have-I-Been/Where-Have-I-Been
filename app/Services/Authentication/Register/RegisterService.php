<?php

declare(strict_types=1);

namespace App\Services\Authentication\Register;

use App\Models\User;
use App\Services\Authentication\BaseAuthService;

class RegisterService extends BaseAuthService implements RegisterServiceInterface
{
    public function register(array $credentials): void
    {
        $credentials["password"] = $this->hashes->make($credentials["password"]);
        User::create($credentials);
    }
}
