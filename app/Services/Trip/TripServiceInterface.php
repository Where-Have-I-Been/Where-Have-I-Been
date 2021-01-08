<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Collection;

interface TripServiceInterface
{
    public function createTrip(array $data, User $user): void;
    public function getTrips(User $user, User $loggedUser): Collection;
    public function updateTrip(Trip $trip, array $data): void;
    public function deleteTrip(Trip $trip);
    public function publishTrip(Trip $trip): void;
}
