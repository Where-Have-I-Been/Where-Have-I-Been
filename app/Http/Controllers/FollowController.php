<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\User;
use App\Services\Follow\FollowServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    private FollowServiceInterface $service;


    public function __construct(FollowServiceInterface $service)
    {
        $this->service = $service;
    }

    public function createFollow(User $user, FollowRequest $request)
    {
        $bool= $this->service->createFollow($request->user(), $user);

        return response()->json([
            "message" => __("resources.created"),
            "data" => $bool,
        ], Response::HTTP_OK);
    }

    public function unfollow(User $user, FollowRequest $request)
    {
        $bool= $this->service->createFollow($request->user(), $user);

        return response()->json([
            "message" => __("resources.created"),
            "data" => $bool,
        ], Response::HTTP_OK);
    }

}
