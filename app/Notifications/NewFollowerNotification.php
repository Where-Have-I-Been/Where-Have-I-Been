<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Rennokki\Befriended\Contracts\Follower;

class NewFollowerNotification extends Notification
{
    use Queueable;

    private Follower $user;

    public function __construct(Follower $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ["database"];
    }

    public function toArray($notifiable)
    {
        return [
            "User "
            . $this->user->userProfile->name
            . " following you",
        ];
    }
}
