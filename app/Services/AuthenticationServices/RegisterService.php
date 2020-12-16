<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Interfaces\RegisterServiceInterface;
use Illuminate\Contracts\Hashing\Hasher;

class RegisterService extends BaseAuthService implements RegisterServiceInterface
{
    public function register(array $credentials): void
    {
        $credentials["password"] = $this->hashes->make($credentials["password"]);
        User::create($credentials);
    }
}
