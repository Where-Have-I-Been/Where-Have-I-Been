<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function changePassword(User $loggedUser, User $userToPatch)
    {
        return $loggedUser->is($userToPatch);
    }
}
