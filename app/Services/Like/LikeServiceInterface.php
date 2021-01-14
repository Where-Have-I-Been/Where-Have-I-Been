<?php

declare(strict_types=1);

namespace App\Services\Like;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Liker;

interface LikeServiceInterface
{
    public function createLike(Model $model, Liker $liker): void;
    public function deleteLike(Model $model, Liker $liker): void;
    public function sortByLikes(Builder $query, string $likableType): Collection;
}
