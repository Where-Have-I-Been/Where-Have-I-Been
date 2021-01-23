<?php

namespace App\Services\Notification;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NotificationGetter implements NotificationGetterInterface
{

    public function getNotifications(User $user, ?string $perPage): LengthAwarePaginator
    {
        return $user->notifications()->paginate($perPage);
    }
}
