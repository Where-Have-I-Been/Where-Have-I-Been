<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\LoginService\LoginServiceInterface;
use App\Services\CountryService\AuthenticationServices\RegisterService\RegisterServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request, LoginServiceInterface $service): JsonResponse
    {
        $token = $service->login($request->validated());

        return response()->json([
            "token" => $token,
        ], Response::HTTP_OK);
    }

    public function register(RegisterRequest $request, RegisterServiceInterface $service): JsonResponse
    {
        $service->register($request->validated());

        return response()->json([
            "message" => __("auth.success"),
        ], Response::HTTP_OK);
    }
}
