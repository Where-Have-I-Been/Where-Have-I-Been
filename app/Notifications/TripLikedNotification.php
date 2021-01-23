<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TripLikedNotification extends Notification
{
    use Queueable;

    private Trip $trip;
    private User $user;

    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ["database"];
    }

    public function toArray($notifiable)
    {
        return [
            "Your trip "
            . $this->trip->name
            . ", was liked by user: "
            . $this->user->userProfile->name,
        ];
    }
}
