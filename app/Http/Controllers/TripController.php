<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use App\Services\Search\SearchServiceInterface;
use App\Services\Trip\QueryTripServiceInterface;
use App\Services\Trip\TripServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private TripServiceInterface $tripService;

    public function __construct(TripServiceInterface $tripService)
    {
        $this->tripService = $tripService;
    }

    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    public function index(Request $request, QueryTripServiceInterface $service)
    {
        $trips = $service->getTrips([
            "city" => $request->query("city"),
            "only-liked" => $request->query("only-liked"),
            "only-followings" => $request->query("only-followings"),
        ],
            $request->query("sort"),
            $request->user());
        return TripResource::collection($trips);
    }

    public function search(Request $request, SearchServiceInterface $service)
    {
        $trips = $service->searchTrips($request->query("search-query"));
        return TripResource::collection($trips);
    }

    public function indexForUser(User $user, Request $request)
    {
        $trips = $this->tripService->getTrips($user, $request->user());
        return TripResource::collection($trips);
    }

    public function create(TripRequest $request)
    {
        $this->tripService->createTrip($request->validated(), $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ],
            Response::HTTP_OK);
    }

    public function update(Trip $trip, UpdateTripRequest $request)
    {
        $this->tripService->updateTrip($trip, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new TripResource($trip),
        ],
            Response::HTTP_OK);
    }

    public function delete(Trip $trip)
    {
        $this->tripService->deleteTrip($trip);

        return response()->json([
            "message" => __("resources.deleted"),
        ],
            Response::HTTP_OK);
    }
}
