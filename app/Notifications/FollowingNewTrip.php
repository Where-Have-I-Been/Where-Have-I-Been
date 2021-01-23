<?php

namespace App\Notifications;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowingNewTrip extends Notification
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
            $this->user->userProfile->name." created trip: ".$this->trip->name,
        ];
    }
}
