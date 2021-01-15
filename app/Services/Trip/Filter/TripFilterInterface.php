<?php

declare(strict_types=1);

namespace App\Services\Trip\Filter;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

interface TripFilterInterface
{
    public function filterTrips(array $filters, User $user): Builder;
}
