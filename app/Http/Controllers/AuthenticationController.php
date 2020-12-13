<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\AppLoginServiceInterface;
use App\Services\Interfaces\AppRegisterServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $service = app(AppLoginServiceInterface::class);
        $token = $service->login($request);

        return response()->json([
            "token" => $token,
        ], Response::HTTP_OK);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $service = app(AppRegisterServiceInterface::class);
        $service->register($request);

        return response()->json([
            "message" => __("auth.success"),
        ], Response::HTTP_OK);
    }
}
