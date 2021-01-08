<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class TripService implements TripServiceInterface
{
    public function createTrip(array $data, User $user): void
    {
        if ($data["photo_id"] !== null && !$user->photos()->where("id", $data["photo_id"])->exists()) {
            throw new AuthorizationException(__("resources.photo_access_denied"));
        }

        Trip::query()->create([
            "user_id" => $user->id,
            "photo_id" => $data["photo_id"],
            "name" => $data["name"],
            "description" => $data["description"],
        ]);
    }

    public function getTrips(User $user, User $loggedUser): Collection
    {
        if ($user->is($loggedUser)) {
            return $user->trips()->get();
        }

        return $user->trips()->where("published", true)->get();
    }

    public function updateTrip(Trip $trip, array $data): void
    {
        $trip->update($data);
    }

    public function deleteTrip(Trip $trip): void
    {
        $trip->delete();
    }

    public function publishTrip(Trip $trip): void
    {
        $trip->published = true;
        $trip->save();
    }
}
