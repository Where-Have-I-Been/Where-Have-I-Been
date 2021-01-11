<?php


namespace App\Http\Controllers;


use App\Models\Place;
use App\Models\Trip;
use App\Services\Like\LikeServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    private LikeServiceInterface $service;

    public function __construct(LikeServiceInterface $service)
    {
        $this->service = $service;
    }

    public function likeTrip(Trip $trip, Request $request): JsonResponse
    {
        $this->service->createLike($trip, $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ], Response::HTTP_OK);
    }

    public function unlikeTrip(Place $trip, Request $request): JsonResponse
    {
        $this->service->deleteLike($trip, $request->user());

        return response()->json([
            "message" => __("resources.deleted"),
        ], Response::HTTP_OK);
    }
}
