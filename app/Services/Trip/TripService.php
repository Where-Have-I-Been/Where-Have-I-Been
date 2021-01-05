<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Collection;


class TripService implements TripServiceInterface
{
    public function createTrip(array $data, User $user): void
    {
        Trip::query()->create([$data, "user_id" => $user->id]);
    }

    public function updateTrip(Trip $trip, array $data): Trip
    {
        $trip->update($data);
        return $trip;
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
