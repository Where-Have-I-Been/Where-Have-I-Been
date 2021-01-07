<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\TripServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private TripServiceInterface $service;

    public function __construct(TripServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(User $user)
    {
        $trips = $this->service->getTrips($user);
        return TripResource::collection($trips);
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

    public function publish(Trip $trip)
    {
        $this->service->publishTrip($trip);

        return response()->json([
            "message" => __("trip.published"),
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
