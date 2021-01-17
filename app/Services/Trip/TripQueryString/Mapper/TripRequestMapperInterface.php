<?php


namespace App\Services\Trip\TripQueryString\Mapper;

use App\Services\Trip\TripQueryString\QueryStringData;

interface TripRequestMapperInterface
{
    public function map(array $data): QueryStringData;
}
