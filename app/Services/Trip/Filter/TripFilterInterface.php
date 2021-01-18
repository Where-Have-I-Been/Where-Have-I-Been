<?php

declare(strict_types=1);

namespace App\Services\Trip\Filter;

use App\Models\User;
use App\Services\Trip\TripQueryString\QueryStringData;
use Illuminate\Database\Eloquent\Builder;

interface TripFilterInterface
{
    public function filterTrips(QueryStringData $data, User $user): Builder;
}
