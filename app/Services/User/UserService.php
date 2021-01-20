<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Services\User\Filter\UserFilterInterface;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    private UserFilterInterface $filter;

    public function __construct(UserFilterInterface $filter)
    {
        $this->filter = $filter;
    }

    public function getUsers(QueryStringData $data, User $user, ?string $perPage): LengthAwarePaginator
    {
        if ($data->isToBeFiltered()) {
            return $this->filter->filterUsers($data, $user)->paginate($perPage);
        }

        return User::query()->paginate($perPage);
    }
}
