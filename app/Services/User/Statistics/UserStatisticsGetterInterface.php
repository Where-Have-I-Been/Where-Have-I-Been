<?php

namespace App\Services\User\Statistics;

use App\Models\User;

interface UserStatisticsGetterInterface
{
    public function getUserStatistics(User $user): array;
}
