<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Follow\FollowServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    private FollowServiceInterface $followService;

    public function __construct(FollowServiceInterface $service)
    {
        $this->followService = $service;
    }

    public function followersIndex(User $user)
    {
        $followers = $this->followService->getFollowers($user);
        return UserResource::collection($followers);
    }

    public function followingIndex(User $user)
    {
        $following = $this->followService->getFollowing($user);
        return UserResource::collection($following);
    }

    public function create(User $user, Request $request)
    {
        $this->followService->createFollow($request->user(), $user);

        return response()->json([
            "message" => __("resources.created"),
        ], Response::HTTP_OK);
    }

    public function delete(User $user, Request $request)
    {
        $this->followService->deleteFollow($request->user(), $user);

        return response()->json([
            "message" => __("resources.deleted"),
        ], Response::HTTP_OK);
    }
}
