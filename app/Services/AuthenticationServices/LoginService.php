<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Exceptions\UnauthenticatedException;
use App\Models\User;
use App\Services\Interfaces\LoginServiceInterface;

class LoginService extends BaseAuthService implements LoginServiceInterface
{
    public function login(array $credentials): string
    {
        $user = $this->getUser($credentials["email"]);
        if ($user === null || !$this->isPasswordCorrect($user, $credentials["password"])) {
            throw new UnauthenticatedException([
                "credentials" => __("auth.failed"),
            ], __("validation.failed"));
        }

        return $user->createToken($user->email)->plainTextToken;
    }

    private function getUser(string $email): ?User
    {
        return User::query()->where("email", $email)->first();
    }

    private function isPasswordCorrect(User $user, string $password): bool
    {
        return $this->hashes->check($password, $user->password);
    }
}
