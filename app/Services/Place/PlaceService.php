<?php

declare(strict_types=1);

namespace App\Services\Place;

use App\Models\Place;
use App\Models\PlacePhoto;
use App\Models\Trip;

class PlaceService implements PlaceServiceInterface
{
    public function createPlace(Trip $trip, array $data): void
    {
        $place = new Place([
            "country" => $data["country"],
            "name" => $data["name"],
            "description" => $data["description"],
            "city" => $data["city"],
            "lng" => $data["lng"],
            "lat" => $data["lat"],
            "user_id" => $trip->user_id,
            "trip_id" => $trip->id,
        ]);
        $place->save();
        $this->addPhotos($place, $data["photos"]);
    }

    public function updatePlace(Place $place, array $data): void
    {
        $place->update($data);
    }

    public function deletePlace(Place $place): void
    {
        $place->delete();
    }

    private function addPhotos(Place $place, array $photos): void
    {
        foreach ($photos as $photoId) {
            PlacePhoto::query()->create([
                "place_id" => $place->id,
                "photo_id" => $photoId,
            ]);
        }
    }
}
