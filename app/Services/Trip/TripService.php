<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Collection;


class TripService implements TripServiceInterface
{
    public function createTrip(array $data, User $user): void
    {
        Trip::query()->create([
            "user_id" => $user->id,
            "name" => $data["name"],
            "description" => $data["description"]
        ]);

    }

    public function updateTrip(Trip $trip, array $data): void
    {
        $trip->update($data);
    }

    public function publishTrip(Trip $trip): void
    {
        $trip->published = true;
        $trip->save();
    }

    public function getTrips(User $user): Collection
    {
        return $user->trips()->get();
    }

    public function deleteTrip(Trip $trip)
    {
        $trip->delete();
    }
}
