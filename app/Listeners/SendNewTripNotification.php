<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewTripEvent;
use App\Notifications\FollowingNewTripNotification;
use Illuminate\Bus\Queueable;

class SendNewTripNotification
{
    use Queueable;

    public function handle(NewTripEvent $event): void
    {
        $followers = $event->user->followers()->get();
        foreach ($followers as $follower) {
            $follower->notify(new FollowingNewTripNotification($event->trip, $event->user));
        }
    }
}
