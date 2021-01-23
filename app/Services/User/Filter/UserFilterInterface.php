<?php

declare(strict_types=1);

namespace App\Services\User\Filter;

use App\Models\User;
use App\Services\User\UserQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface UserFilterInterface
{
    public function filterUsers(QueryStringData $data, User $user): MorphToMany;
}
