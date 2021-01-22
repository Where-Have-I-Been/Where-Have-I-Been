<?php

declare(strict_types=1);

namespace App\Services\User\UserQueryString\Mapper;

use App\Services\User\UserQueryString\QueryStringData;

interface UserMapperInterface
{
    public function map(array $data): QueryStringData;
}
