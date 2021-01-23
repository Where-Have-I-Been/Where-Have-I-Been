<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewLikeEvent;
use App\Notifications\TripLikedNotification;

class SendTripLikedNotification
{
    public function handle(NewLikeEvent $event): void
    {
        $event->trip->user->notify(new TripLikedNotification($event->trip, $event->user));
    }
}
