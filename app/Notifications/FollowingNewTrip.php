<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowingNewTrip extends Notification
{
    use Queueable;



    public function __construct()
    {
        //
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
