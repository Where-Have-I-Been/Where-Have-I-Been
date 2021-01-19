<?php

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
       $query = User::query();
       if ($data->isToBeFiltered()) {
           $query = $this->filter->filterTrips($data, $user);
       }

       return $query->paginate($perPage);
   }
}
