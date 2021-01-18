<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TripServiceInterface
{
    public function createTrip(array $data, User $user): void;
    public function getTrips(QueryStringData $data, User $user, ?string $perPage): LengthAwarePaginator;
    public function getUserTrips(User $user, User $loggedUser, ?string $perPage): LengthAwarePaginator;
    public function updateTrip(Trip $trip, array $data): void;
    public function deleteTrip(Trip $trip);
}
