<?php

declare(strict_types=1);

namespace App\Services\Place;

use App\Models\Place;
use App\Models\PlacePhoto;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class PlaceService implements PlaceServiceInterface
{
    public function createPlace(Trip $trip, array $data): void
    {
        Place::query()->create([
            "country" => $data["country"],
            "name" => $data["name"],
            "description" => $data["description"],
            "city" => $data["city"],
            "lng" => $data["lng"],
            "lat" => $data["lat"],
            "user_id" => $trip->user_id,
            "trip_id" => $trip->id,
        ]);
    }

    public function updatePlace(Place $place, array $data): void
    {
        $place->update($data);
    }

    public function deletePlace(Place $place): void
    {
        $place->delete();
    }

    public function addPhoto(User $user, Place $place, string $photoId): void
    {
        if (!$user->photos()->where("id", $photoId)->exists()) {
            throw new AuthorizationException(__("resources.photo_access_denied"));
        }

        PlacePhoto::query()->create([
            "place_id" => $place->id,
            "photo_id" => $photoId,
        ]);
    }
}
