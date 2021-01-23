<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewFollowEvent;
use App\Notifications\NewFollowerNotification;
use Illuminate\Bus\Queueable;

class SendNewFollowNotification
{
    use Queueable;

    public function handle(NewFollowEvent $event): void
    {
            $event->following->notify(new NewFollowerNotification($event->follower));
    }
}
