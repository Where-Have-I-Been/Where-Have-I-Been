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

    public function view(User $user, Trip $trip)
    {
        return $trip->published === 1 || $trip->user->is($user);
    }
}
