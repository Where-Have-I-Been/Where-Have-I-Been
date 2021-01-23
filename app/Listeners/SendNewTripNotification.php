<?php

namespace App\Listeners;

use App\Events\NewTripEvent;
use App\Models\User;
use App\Notifications\FollowerTripLiked;
use App\Notifications\FollowingNewTrip;

class SendNewTripNotification
{
    public function handle(NewTripEvent $event)
    {
        /** @var User $followers */
        $followers = $event->user->followers();
        foreach ($followers as $follower){
            $follower->notify( new FollowingNewTrip($event->trip,$event->user));
        }
    }
}
