<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\UserProfile;
use App\Services\Interfaces\UserProfileServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{
    private UserProfileServiceInterface $service;

    public function __construct(UserProfileServiceInterface $service)
    {
        $this->service = $service;
    }

    public function show(UserProfile $profile, Request $request): JsonResponse
    {
        $resource = $this->service->getProfile($profile, $request->user());
        return response()->json([
            "message" => $resource,
        ], Response::HTTP_OK);
    }

    public function update(UserProfile $profile, UpdateProfileRequest $request): JsonResponse
    {
        $this->authorize("update", $profile);
        $this->service->updateProfile($profile, $request->validated());
        return response()->json([
            "message" => "success",
        ], Response::HTTP_OK);
    }

}
