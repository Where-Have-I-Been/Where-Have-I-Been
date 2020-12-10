<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthenticationServices\AppLoginService;
use App\Http\Services\AuthenticationServices\AppRegisterService;
use App\Http\Services\Interfaces\AppLoginServiceInterface;
use App\Http\Services\Interfaces\AppRegisterServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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


    public function login(Request $request) : JsonResponse
    {
        $token = $this->appLoginService->login($request);
        return response()->json(["token" => $token],Response::HTTP_OK);
    }

    public function register(Request $request): JsonResponse
    {
        $this->appRegisterService->register($request);
        return response()->json(["message"=>"Registration Successfully"],Response::HTTP_OK);
    }
}
