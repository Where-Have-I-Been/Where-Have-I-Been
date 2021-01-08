<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;

    public function changeState(User $user, Place $place)
    {
        return $place->user->is($user);
    }
}
