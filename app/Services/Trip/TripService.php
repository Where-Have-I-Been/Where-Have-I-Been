<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
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

    public function getTrips(User $user, User $loggedUser): Collection
    {
        if ($user->is($loggedUser)){
            return $user->trips()->get();
        }

        return $user->trips()->where("published",true)->get();
    }

    public function deleteTrip(Trip $trip)
    {
        $trip->delete();
    }

    public function checkAccess(Trip $trip, User $loggedUser): void
    {
        if ($trip->published === false && !$trip->user->is($loggedUser)) {
            throw new AuthorizationException(__("resources.access_denied"));
        }
    }
}
