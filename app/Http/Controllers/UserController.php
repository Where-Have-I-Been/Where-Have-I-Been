<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Authentication\Password\PasswordServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private PasswordServiceInterface $service;

    public function __construct(PasswordServiceInterface $service)
    {
        $this->service = $service;
    }

    public function show(Request $request): JsonResource
    {
        return new UserResource($request->user());
    }

    public function changePassword(User $user, ChangePasswordRequest $request): JsonResponse
    {
        $this->service->changePassword($request->validated(), $user);

        return response()->json([
            "message" => __("passwords.updated"),
        ], Response::HTTP_OK);
    }
}
