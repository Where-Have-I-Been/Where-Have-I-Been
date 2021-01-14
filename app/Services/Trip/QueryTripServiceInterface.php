<?php

declare(strict_types=1);

namespace App\Services\Trip;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface QueryTripServiceInterface
{
    public function getTrips(array $filtersParameters, ?string $sortParameter, User $user): Collection;
}
