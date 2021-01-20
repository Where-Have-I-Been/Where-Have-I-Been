<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function getUsers(QueryStringData $data, User $user, ?string $perPage): LengthAwarePaginator;
}
