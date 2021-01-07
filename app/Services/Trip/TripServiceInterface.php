<?php


namespace App\Services\Trip;


use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Collection;

interface TripServiceInterface
{
    public function checkAccess(Trip $trip, User $loggedUser): void;
    public function getTrips(User $user, User $loggedUser): Collection;
    public function createTrip(array $data, User $user): void;
    public function updateTrip(Trip $trip, array $data): void;
    public function publishTrip(Trip $trip): void;
    public function deleteTrip(Trip $trip);
}
