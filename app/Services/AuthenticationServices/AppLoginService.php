<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\Interfaces\AppLoginServiceInterface;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Exceptions\HttpResponseException;

use Symfony\Component\HttpFoundation\Response;

class AppLoginService implements AppLoginServiceInterface
{
    private Hasher $hashes;

    public function __construct(Hasher $hashes)
    {
        $this->hashes = $hashes;
    }

    public function login(LoginRequest $request): string
    {
        $user = $this->getUser($request);
        if ($this->passwordIsIncorrect($user, $request)) {
            $this->authenticationFailed();
        }
        return $user->createToken($user->email)->plainTextToken;
    }

    private function getUser(LoginRequest $request): object
    {
        $user = User::query()->where("email", $request->__get("email"))->first();
        if ($user === null) {
            $this->authenticationFailed();
        }
        return $user;
    }

    private function authenticationFailed(): void
    {
        throw new HttpResponseException(response()->json(
            [
                "message" => "auth.failed",
            ], Response::HTTP_UNAUTHORIZED));
    }

    private function passwordIsIncorrect(object $user, LoginRequest $request): bool
    {
        return !$this->hashes->check($request->__get("password"), $user->password);
    }
}
