<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\UserProfile;
use App\Services\UserProfile\UserProfileServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{
    private UserProfileServiceInterface $profilesService;

    public function __construct(UserProfileServiceInterface $service)
    {
        $this->profilesService = $service;
    }

    public function show(UserProfile $profile, Request $request): JsonResource
    {
        $profileData = $this->profilesService->getProfile($profile, $request->user(), $request->input("representation"));

        return new ProfileResource($profileData);
    }

    public function update(UserProfile $profile, UpdateProfileRequest $request): JsonResponse
    {
        $profile = $this->profilesService->updateProfile($profile, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new ProfileResource($profile),
        ], Response::HTTP_OK);
    }
}
