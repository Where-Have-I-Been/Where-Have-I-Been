<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Services\Country\AuthenticationServices\RegisterService\PasswordService\PasswordServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private PasswordServiceInterface $service;

    public function __construct(PasswordServiceInterface $service)
    {
        $this->service = $service;
    }

    public function update(User $user, ChangePasswordRequest $request): JsonResponse
    {
        $this->authorize("changePassword", $user);
        $this->service->changePassword($request->validated(), $user);

        return response()->json([
            "message" => __("Password changes successfully"),
        ], Response::HTTP_OK);
    }
}
