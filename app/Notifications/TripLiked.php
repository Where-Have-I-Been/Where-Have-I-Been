<?php

namespace App\Notifications;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TripLiked extends Notification
{
    use Queueable;

    private Trip $trip;
    private User $user;

    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;
        $this->user = $user;
    }

    public function toArray($notifiable)
    {
        return [
            $this->trip->name." was liked by: ".$this->user->userProfile->name,
        ];
    }
}
