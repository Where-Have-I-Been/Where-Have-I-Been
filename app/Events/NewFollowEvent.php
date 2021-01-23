<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Following;

class NewFollowEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private Follower $follower;

    private Following $following;

    public function __construct(Follower $follower, Following $following)
    {

        $this->follower = $follower;
        $this->following = $following;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
