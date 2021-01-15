<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\Filter\TripFilterInterface;
use App\Services\Trip\Sorter\TripSorterInterface;
use Illuminate\Support\Collection;

class TripService implements TripServiceInterface
{
    public function createTrip(array $data, User $user): void
    {
        Trip::query()->create([
            "user_id" => $user->id,
            "photo_id" => $data["photo_id"],
            "name" => $data["name"],
            "description" => $data["description"],
        ]);
    }

    public function getTrips(array $filters, ?string $sortBy, User $user): Collection
    {
        $filter = app(TripFilterInterface::class);
        $sorter = app(TripSorterInterface::class);
        $query = $filter->filterTrips($filters, $user);
        return $sorter->sortTrips($query, $sortBy);
    }


    public function getUserTrips(User $user, User $loggedUser): Collection
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
}
