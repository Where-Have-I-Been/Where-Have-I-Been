<?php

namespace App\Services\User\Filter;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

interface UserFilterInterface
{
    public function filterTrips(QueryStringData $data, User $user): Builder;

}
