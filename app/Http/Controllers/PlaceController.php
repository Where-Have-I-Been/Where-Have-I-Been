<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Models\Trip;
use App\Services\Place\PlaceServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    private PlaceServiceInterface $service;

    public function __construct(PlaceServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(Trip $trip, PlaceRequest $request)
    {
        $this->service->createPlace($trip, $request->validated());

        return response()->json([
            "message" => __("resources.created"),
        ],
            Response::HTTP_OK);
    }

    public function update(Place $place, UpdatePlaceRequest $request)
    {
        $this->service->updatePlace($place, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new PlaceResource($place),
        ],
            Response::HTTP_OK);
    }

    public function delete(Place $place)
    {
        $this->service->deletePlace($place);

        return response()->json([
            "message" => __("resources.deleted"),
        ],
            Response::HTTP_OK);
    }
}
