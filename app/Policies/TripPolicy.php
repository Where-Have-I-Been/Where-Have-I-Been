<?php


namespace App\Policies;


use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Trip $trip)
    {
        return $trip->user->is($user);
    }

}
