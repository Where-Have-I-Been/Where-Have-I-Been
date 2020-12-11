<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Http\Requests\LoginRequest;
use App\Services\Interfaces\AppLoginServiceInterface;
use App\Models\User;
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
        $user = $this->authenticateUser($request);
        return $user->createToken($user->email)->plainTextToken;
    }

    private function authenticateUser(LoginRequest $request): object
    {
       $user = User::query()->where("email", $request->__get("email"))->first();
        if ($user === null || $this->passwordIsInCorrect($user,$request) ){
            throw new HttpResponseException(response()->json(
                [
                    "message" => "auth.failed",
                ], Response::HTTP_UNAUTHORIZED));
        }
        return $user;
    }

    private function passwordIsInCorrect(object $user, LoginRequest $request): bool
    {
        return !$this->hashes->check($request->__get("password"), $user->password);
    }
}
