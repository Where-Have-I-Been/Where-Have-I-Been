<?php

declare(strict_types=1);

namespace App\Services\Like;

use App\Exceptions\ResourceException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Liker;

class LikeService implements LikeServiceInterface
{
    public function createLike(Model $model, Liker $liker): void
    {
        $result = $liker->like($model);

        if ($result === false) {
            throw new ResourceException("you can't create this resource");
        }
    }

    public function deleteLike(Model $model, Liker $liker): void
    {
        $result = $liker->unlike($model);

        if ($result === false) {
            throw new ResourceException("you can't delete this resource");
        }
    }

    public function sortByLikes(Builder $query, string $likableType): Collection
    {
        return $query->with("likers")->get()->sortByDesc(function ($trip) use ($likableType) {
            return $trip->likers($likableType)->count();
        });
    }
}
