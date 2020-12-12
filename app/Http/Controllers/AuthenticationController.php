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
    private AppLoginServiceInterface $appLoginService;
    private AppRegisterServiceInterface $appRegisterService;

    public function __construct(
        AppLoginServiceInterface $appLoginService, AppRegisterServiceInterface $appRegisterService)
    {
        $this->appLoginService = $appLoginService;
        $this->appRegisterService = $appRegisterService;
    }


    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->appLoginService->login($request);
        return response()->json([
            "token" => $token,
        ], Response::HTTP_OK);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $this->appRegisterService->register($request);
        return response()->json([
            "message" => __("auth.success"),
        ], Response::HTTP_OK);
    }
}
