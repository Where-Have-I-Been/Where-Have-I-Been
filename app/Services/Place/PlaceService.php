<?php

namespace App\Services\Place;

use App\Models\Place;
use App\Models\PlacePhoto;
use App\Models\Trip;

class PlaceService implements PlaceServiceInterface
{

    public function createPlace(Trip $trip, array $data): void
    {
        Place::query()->create([
            $data,
            "user_id" => $trip->user_id,
            "trip_id" => $trip->id,
        ]);
    }

    public function updatePlace(Place $place, array $data): Place
    {
        $place->update($data);
        return $place;
    }

    public function deletePlace(Place $place): void
    {
        $place->delete();
    }

    public function addPhoto(Place $place, string $photoId): void
    {
        PlacePhoto::query()->create([
            "place_id" => $place->id,
            "photo_id" => $photoId,
        ]);
    }
}
