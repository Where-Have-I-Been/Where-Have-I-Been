<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\PaginationCollection;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapperInterface;
use App\Services\Trip\TripServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private TripServiceInterface $service;

    public function __construct(TripServiceInterface $tripService)
    {
        $this->service = $tripService;
    }

    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    public function index(Request $request, TripRequestMapperInterface $mapperService)
    {
        $trips = $this->service->getTrips($mapperService->map(
            $request->only("sort", "country", "city", "only-followings", "only-liked")),
            $request->user(),
            $request->input("per-page"));
        return new PaginationCollection($trips);
    }

    public function search(Request $request)
    {
        $trips = $this->service->searchTrips($request->query("search-query"), $request->input("per-page"));
        return new PaginationCollection($trips);
    }

    public function indexForUser(User $user, Request $request)
    {
        $trips = $this->service->getUserTrips($user, $request->user(), $request->input("per-page"));
        return new PaginationCollection($trips);
    }

    public function create(TripRequest $request)
    {
        $this->service->createTrip($request->validated(), $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ],
            Response::HTTP_OK);
    }

    public function update(Trip $trip, UpdateTripRequest $request)
    {
        $this->service->updateTrip($trip, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new TripResource($trip),
        ],
            Response::HTTP_OK);
    }

    public function delete(Trip $trip)
    {
        $this->service->deleteTrip($trip);

        return response()->json([
            "message" => __("resources.deleted"),
        ],
            Response::HTTP_OK);
    }
}
