<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Models\User;
use App\Services\Interfaces\LoginServiceInterface;
use Illuminate\Auth\AuthenticationException;

class LoginService extends BaseAuthService implements LoginServiceInterface
{
    public function login(array $credentials): string
    {
        $user = $this->getUser($credentials["email"]);
        if ($user === null || !$this->isPasswordCorrect($user, $credentials["password"])) {
            throw new AuthenticationException(__("auth.failed"));
        }

        return $user->createToken($user->email)->plainTextToken;
    }

    private function getUser(string $email): ?User
    {
        return User::query()->where("email", $email)->first();
    }
}
