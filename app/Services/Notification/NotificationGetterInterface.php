<?php

namespace App\Services\Notification;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotificationGetterInterface
{
    public function getNotifications(User $user, ?string $perPage): LengthAwarePaginator;
}
