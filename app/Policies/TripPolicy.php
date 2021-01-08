<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    public function changeState(User $user, Trip $trip)
    {
        return $trip->user->is($user);
    }

    public function getTrip(User $user, Trip $trip)
    {
        return $trip->published === true || $trip->user->is($user);
    }
}
