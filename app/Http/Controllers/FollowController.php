<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FollowCollection;
use App\Models\User;
use App\Services\Follow\FollowServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    private FollowServiceInterface $service;

    public function __construct(FollowServiceInterface $service)
    {
        $this->service = $service;
    }

    public function followersIndex(User $user)
    {
        $followers = $this->service->getFollowers($user);
        return new FollowCollection($followers);
    }

    public function followingIndex(User $user)
    {
        $following = $this->service->getFollowing($user);
        return new FollowCollection($following);
    }

    public function create(User $user, Request $request)
    {
        $result = $this->service->createFollow($request->user(), $user);
        return response()->json([
            "message" => [
                "result" => $result,
            ],
        ], Response::HTTP_OK);
    }

    public function delete(User $user, Request $request)
    {
        $result = $this->service->deleteFollow($request->user(), $user);
        return response()->json([
            "message" => [
                "result" => $result,
            ],
        ], Response::HTTP_OK);
    }
}
