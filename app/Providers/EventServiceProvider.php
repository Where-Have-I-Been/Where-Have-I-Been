<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\NewFollowEvent;
use App\Events\NewLikeEvent;
use App\Events\NewTripEvent;
use App\Listeners\SendNewFollowNotification;
use App\Listeners\SendNewTripNotification;
use App\Listeners\SendTripLikedNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewLikeEvent::class => [
            SendTripLikedNotification::class,
        ],
        NewTripEvent::class => [
            SendNewTripNotification::class,
        ],
        NewFollowEvent::class => [
            SendNewFollowNotification::class,
        ],
    ];

    public function boot(): void
    {
        User::observe(UserObserver::class);
    }


}
