<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\Filter\TripFilterInterface;
use App\Services\Trip\TripQueryString\QueryStringData;
use App\Services\Trip\Sorter\TripSorterInterface;
use Illuminate\Support\Collection;

class TripService implements TripServiceInterface
{
    protected TripFilterInterface $filter;
    protected TripSorterInterface $sorter;

    public function __construct(TripFilterInterface $filter, TripSorterInterface $sorter)
    {
        $this->filter = $filter;
        $this->sorter = $sorter;
    }

    public function createTrip(array $data, User $user): void
    {
        Trip::query()->create([
            "user_id" => $user->id,
            "photo_id" => $data["photo_id"],
            "name" => $data["name"],
            "description" => $data["description"],
        ]);
    }

    public function getTrips(QueryStringData $data, User $user): Collection
    {
        $query = Trip::query();
        if ($data->isToBeFiltered()) {
            $query = $this->filter->filterTrips($data, $user);
        }
        if ($data->isToBeSorted()) {
            return $this->sorter->sort($query, $data);
        }

        return $query->get();
    }

    public function getUserTrips(User $user, User $loggedUser): Collection
    {
        if ($user->is($loggedUser)) {
            return $user->trips()->with("places")->get();
        }

        return $user->trips()->where("published", true)->with("places")->get();
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
