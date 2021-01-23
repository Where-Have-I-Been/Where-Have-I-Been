<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Following;

class NewFollowEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Follower $follower;

    public Following $following;

    public function __construct(Follower $follower, Following $following)
    {
        $this->follower = $follower;
        $this->following = $following;
    }

}
