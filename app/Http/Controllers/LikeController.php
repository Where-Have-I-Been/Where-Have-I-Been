<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Services\Like\TripLikeServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    private TripLikeServiceInterface $likesService;

    public function __construct(TripLikeServiceInterface $service)
    {
        $this->likesService = $service;
    }

    public function likeTrip(Trip $trip, Request $request): JsonResponse
    {
        $this->likesService->createLike($trip, $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ], Response::HTTP_OK);
    }

    public function unlikeTrip(Trip $trip, Request $request): JsonResponse
    {
        $this->likesService->deleteLike($trip, $request->user());

        return response()->json([
            "message" => __("resources.deleted"),
        ], Response::HTTP_OK);
    }
}
