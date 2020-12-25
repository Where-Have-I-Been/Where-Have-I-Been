<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\UserProfile;
use App\Services\UserProfile\UserProfileServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{
    private UserProfileServiceInterface $service;

    public function __construct(UserProfileServiceInterface $service)
    {
        $this->service = $service;
    }

    public function show(UserProfile $profile, Request $request): JsonResource
    {
        return $this->service->getProfile($profile, $request->user(), $request->input("representation"));
    }

    public function update(UserProfile $profile, UpdateProfileRequest $request): JsonResponse
    {
        $profile = $this->service->updateProfile($profile, $request->validated());

        return response()->json([
            "message" => "resources.updated",
            "data" => $profile,
        ], Response::HTTP_OK);
    }
}
