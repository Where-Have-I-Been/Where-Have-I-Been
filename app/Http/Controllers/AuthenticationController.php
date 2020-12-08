<?php


namespace App\Http\Controllers;


use App\Http\Services\AuthenticationServices\AppAuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    private AppAuthenticationService $appAuthenticationService;


    public function __construct(AppAuthenticationService $appAuthService)
    {
        $this->appAuthenticationService = $appAuthService;
    }

    public function login(Request $request) : JsonResponse
    {
        $token = $this->appAuthenticationService->login($request);
        return response()->json(["token" => $token],Response::HTTP_OK);
    }

    public function register(Request $request): JsonResponse
    {
        $this->appAuthenticationService->register($request);
        return response()->json(["message"=>"Registration Successfully"],Response::HTTP_OK);
    }
}
