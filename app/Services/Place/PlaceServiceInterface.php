<?php

declare(strict_types=1);

namespace App\Services\Place;

use App\Models\Place;
use App\Models\Trip;
use App\Models\User;

interface PlaceServiceInterface
{
    public function createPlace(Trip $trip, array $data): void;
    public function updatePlace(Place $place, array $data): void;
    public function deletePlace(Place $place): void;
    public function addPhoto(User $user, Place $place, string $photoId): void;
}
