<?php

declare(strict_types=1);

namespace App\Testing\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

trait LoggingIn
{
    /**
     * @Given a user is logged in as :email
     */
    public function userIsLoggedInAs(string $email): void
    {
        /** @var Guard $guard */
        $guard = app(Guard::class);

        /** @var Authenticatable $user */
        $user = User::query()->where("email", $email)->first();

        $guard->setUser($user);
    }
}
