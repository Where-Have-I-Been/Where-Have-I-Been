<?php

namespace App\Services\User\Statistics;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserStatisticsGetter implements UserStatisticsGetterInterface
{
    public function getUserStatistics(User $user): array
    {
        return [
            "trips_count" => $user->trips()->count(),
            "likes_count" => $user->trips()->count("likes_count"),
            "followers_count" => $user->followers()->count(),
            "followings_count" => $user->following()->count(),
            "visited_places_count" => $this->getPlacesCount($user),
        ];
    }

    private function getPlacesCount(User $user): int
    {
        return Place::query()->whereHas("trip",function (Builder $query) use($user){
            $query->whereHas("user",function (Builder $query) use ($user) {
                $query->where("id", $user->id);
            });
        })->count();
    }
}
