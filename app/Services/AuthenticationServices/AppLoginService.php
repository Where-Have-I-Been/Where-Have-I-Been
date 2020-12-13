<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Exceptions\UnauthenticatedException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\Interfaces\AppLoginServiceInterface;
use Illuminate\Contracts\Hashing\Hasher;

class AppLoginService implements AppLoginServiceInterface
{
    protected Hasher $hashes;

    public function __construct(Hasher $hashes)
    {
        $this->hashes = $hashes;
    }

    public function login(LoginRequest $request): string
    {
        $user = $this->getUser($request->input("email"));
        if ($user === null || !$this->isPasswordCorrect($user, $request->input("password"))) {
            throw new UnauthenticatedException(__("auth.failed"));
        }

        return $user->createToken($user->email)->plainTextToken;
    }

    private function getUser(string $email): ?User
    {
        /** @var User $user */
        return User::query()->where("email", $email)->first();
    }

    private function isPasswordCorrect(User $user, string $password): bool
    {
        return $this->hashes->check($password, $user->password);
    }
}
