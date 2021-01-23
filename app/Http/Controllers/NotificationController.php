<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationsCollection;
use App\Models\User;
use App\Services\Notification\NotificationGetterInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationController extends Controller
{
    private NotificationGetterInterface $getter;


    public function __construct(NotificationGetterInterface $getter)
    {
        $this->getter = $getter;
    }

    public function index(User $user, Request $request): ResourceCollection
    {
        $notifications = $this->getter->getNotifications($user, $request->input("per-page"));

        return new NotificationsCollection($notifications);
    }
}
