<?php


namespace App\Services\User\UserQueryString\Mapper;


use App\Services\User\UserQueryString\QueryStringData;

interface UserMapperInterface
{
    public function map(array $data): QueryStringData;

}
