<?php

declare(strict_types=1);

namespace App\Services\Like;

use App\Models\Trip;
use App\Models\User;

interface TripLikeServiceInterface
{
    public function createLike(Trip $model, User $liker): void;
    public function deleteLike(Trip $model, User $liker): void;
}
