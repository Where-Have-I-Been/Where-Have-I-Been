<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Events\NewFollowEvent;
use App\Events\NewLikeEvent;
use App\Events\NewTripEvent;
use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\Filter\TripFilterInterface;
use App\Services\Trip\Sorter\TripSorterInterface;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
        $trip = new Trip([
            "user_id" => $user->id,
            "nat_id" => $user->userProfile->country_id,
            "name" => $data["name"],
            "description" => $data["description"],
        ]);
        if (array_key_exists("photo_id", $data)) {
            $trip->photo_id = $data["photo_id"];
        }
        $trip->save();
        event(new NewTripEvent($trip, $user));
    }

    public function getTrips(QueryStringData $data, User $user, ?string $perPage): LengthAwarePaginator
    {
        $query = Trip::query();

        if ($data->isToBeFiltered()) {
            $query = $this->filter->filterTrips($data, $user);
        }
        if ($data->isToBeSorted()) {
            $query = $this->sorter->sort($query, $data);
        }

        return $query->paginate($perPage);
    }

    public function getUserTrips(User $user, User $loggedUser, ?string $perPage): LengthAwarePaginator
    {
        if ($user->is($loggedUser)) {
            return $user->trips()->withoutGlobalScope("published")->paginate($perPage);
        }

        return $user->trips()->paginate($perPage);
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
