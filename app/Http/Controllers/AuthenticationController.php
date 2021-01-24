<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Authentication\External\FacebookAuthService;
use App\Services\Authentication\Login\LoginServiceInterface;
use App\Services\Authentication\Register\RegisterServiceInterface;
use Illuminate\Http\JsonResponse;
use  \Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
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

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver("facebook")->redirect();
    }

    public function handleFacebookCallback(FacebookAuthService $authenticationService): JsonResponse
    {
        $facebookUser = Socialite::driver("facebook")->user();
        $token = $authenticationService->getToken($facebookUser, "facebook");

        return response()->json([
            "token" => $token,
        ]);
    }
}
