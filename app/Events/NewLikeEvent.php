<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLikeEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Trip $trip;

    public User $user;

    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;
        $this->user = $user;
    }
}
