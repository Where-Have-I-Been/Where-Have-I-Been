<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripCollection;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapperInterface;
use App\Services\Trip\TripServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private TripServiceInterface $service;

    public function __construct(TripServiceInterface $tripService)
    {
        $this->service = $tripService;
    }

    public function show(Trip $trip, Request $request): JsonResource
    {
        return new TripResource($trip, $request->user());
    }

    public function index(Request $request, TripRequestMapperInterface $mapperService)
    {
        $trips = $this->service->getTrips($mapperService->map(
            $request->only("sort", "country", "city", "only-followings", "only-liked", "search-query")),
            $request->user(),
            $request->input("per-page"));
        return new TripCollection($trips, $request->user());
    }

    public function indexForUser(User $user, Request $request): ResourceCollection
    {
        $trips = $this->service->getUserTrips($user, $request->user(), $request->input("per-page"));
        return new TripCollection($trips, $request->user());
    }

    public function create(TripRequest $request): JsonResponse
    {
        $this->service->createTrip($request->validated(), $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ],
            Response::HTTP_OK);
    }

    public function update(Trip $trip, UpdateTripRequest $request): JsonResponse
    {
        $this->service->updateTrip($trip, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new TripResource($trip, $request->user()),
        ],
            Response::HTTP_OK);
    }

    public function delete(Trip $trip): JsonResponse
    {
        $this->service->deleteTrip($trip);

        return response()->json([
            "message" => __("resources.deleted"),
        ],
            Response::HTTP_OK);
    }
}
